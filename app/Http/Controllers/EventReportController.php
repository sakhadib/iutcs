<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

use App\Models\Fest;
use App\Models\Event;
use App\Models\EventRegistrationLog;
use App\Models\RegistrationQuestionField;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\EventRegQuestionAnswer;


class EventReportController extends Controller
{
    public function generate($id)
    {
        // 1. Pull main event
        $event = DB::table('events')->where('id', $id)->first();
        if (!$event) abort(404);

        // 2. Pull fest
        $fest = DB::table('fests')->where('id', $event->fest_id)->first();

        // 3. Pull questions
        $questions = DB::table('registration_question_fields')->where('event_id', $id)->get();

        // 4. Pull all teams who registered to this event
        $teams = DB::table('event_registration_logs')
            ->where('event_id', $id)
            ->join('teams', 'event_registration_logs.team_id', '=', 'teams.id')
            ->select('teams.*', 'event_registration_logs.status')
            ->get();

        // 5. Pull team members + answers
        $teamData = [];
        foreach ($teams as $team) {
            $members = DB::table('team_members')
                ->where('team_id', $team->id)
                ->join('users', 'team_members.user_id', '=', 'users.id')
                ->select('users.*', 'team_members.role')
                ->get();

            $answers = DB::table('event_reg_question_answers')
                ->where('event_reg_question_answers.team_id', $team->id)
                ->where('event_reg_question_answers.event_id', $id) // <-- FIXED: Fully qualified
                ->join('registration_question_fields', 'event_reg_question_answers.question_id', '=', 'registration_question_fields.id')
                ->select('registration_question_fields.question', 'event_reg_question_answers.answer')
                ->get();


            $teamData[] = [
                'team' => $team, 
                'members' => $members,
                'answers' => $answers,
            ];
        }

        $pdf = Pdf::loadView('pdf.event_report', compact('event', 'fest', 'questions', 'teamData'));
        
        $safeFestTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $fest->title);
        $safeEventTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $event->title);
        return $pdf->download('full_report_' . $safeFestTitle . '_' . $safeEventTitle . '.pdf');
    }


    public function generateEventSummaryReport($eventId)
    {
        $event = Event::findOrFail($eventId);
        if(!$event) {
            return redirect('/404');
        }

        $fest = Fest::findOrFail($event->fest_id);
        if(!$fest) {
            return redirect('/404');
        }

        // Get all teams registered for this event
        $registrationLogs = EventRegistrationLog::where('event_id', $eventId)->get();

        $totalTeams = $registrationLogs->count();
        $approvedTeams = $registrationLogs->where('status', 'accepted')->count();
        $pendingTeams = $registrationLogs->where('status', 'pending')->count();
        $rejectedTeams = $registrationLogs->where('status', 'rejected')->count();

        $teams = $registrationLogs->map(function ($log) {
            $team = Team::find($log->team_id);
            $members = TeamMember::where('team_id', $team->id)->get();

            $memberDetails = $members->map(function ($member) {
                $user = User::find($member->user_id);
                return [
                    'name' => $user->name,
                    'role' => $member->role
                ];
            });

            return [
                'id' => $team->id,
                'name' => $team->name,
                'member_count' => $members->count(),
                'members' => $memberDetails,
                'status' => $log->status
            ];
        });

        $pdf = Pdf::loadView('pdf.event_summary_report', [
            'event' => $event,
            'fest' => $fest,
            'totalTeams' => $totalTeams,
            'approvedTeams' => $approvedTeams,
            'pendingTeams' => $pendingTeams,
            'rejectedTeams' => $rejectedTeams,
            'teams' => $teams
        ])->setPaper('A4', 'portrait');

        $safeFestTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $fest->title);
        $safeEventTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $event->title);
        return $pdf->download('event_summary_' . $safeFestTitle . '_' . $safeEventTitle . '.pdf');
    }


    public function exportRegistrationQnAAsCSV($eventId)
{
    // Get all unique questions for the event
    $questions = DB::table('registration_question_fields')
        ->where('event_id', $eventId)
        ->orderBy('id')
        ->get();

    $questionIds = $questions->pluck('id')->toArray();

    // Prepare headers
    $csvHeaders = ['team_id', 'team_name'];
    foreach ($questions as $q) {
        $csvHeaders[] = $q->question;
    }

    // Get teams registered for the event
    $teams = DB::table('event_registration_logs')
        ->where('event_id', $eventId)
        ->pluck('team_id');

    $rows = [];

    foreach ($teams as $teamId) {
        $team = DB::table('teams')->where('id', $teamId)->first();

        $row = [
            $team->id,
            $team->name
        ];

        // Get answers for this team
        $answers = DB::table('event_reg_question_answers')
            ->join('registration_question_fields', 'event_reg_question_answers.question_id', '=', 'registration_question_fields.id')
            ->where('event_reg_question_answers.team_id', $teamId)
            ->where('registration_question_fields.event_id', $eventId)
            ->select('event_reg_question_answers.question_id', 'event_reg_question_answers.answer')
            ->get()
            ->keyBy('question_id');

        // Add answers in the correct order
        foreach ($questionIds as $qid) {
            $row[] = isset($answers[$qid]) ? $answers[$qid]->answer : '';
        }

        $rows[] = $row;
    }

    // Create CSV
    $filename = 'event_qna_export.csv';
    $handle = fopen('php://temp', 'r+');
    fputcsv($handle, $csvHeaders);

    foreach ($rows as $row) {
        fputcsv($handle, $row);
    }

    rewind($handle);
    $csvContent = stream_get_contents($handle);
    fclose($handle);

    return Response::make($csvContent, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ]);
}
}
