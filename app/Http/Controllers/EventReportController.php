<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

use App\Models\Fest;
use App\Models\Event;
use App\Models\EventRegistrationLog;
use App\Models\RegistrationQuestionField;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\EventRegQuestionAnswer;
use App\Models\UserInfo;


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




    public function generateParticipantListReport($eventId)
    {
        $event = Event::findOrFail($eventId);
        $fest = Fest::findOrFail($event->fest_id);

        $registrationLogs = EventRegistrationLog::where('event_id', $eventId)->where('status', 'Approved')->get();
        $teamsData = [];
        $totalParticipants = 0;

        foreach ($registrationLogs as $log) {
            $team = Team::find($log->team_id);
            $members = TeamMember::where('team_id', $team->id)->get();

            $memberDetails = $members->map(function ($member) {
                $user = User::find($member->user_id);
                return [
                    'name' => $user->name ?? '',
                    'student_id' => $user->student_id ?? '',
                    'phone' => $user->phone ?? '',
                ];
            });

            $totalParticipants += $memberDetails->count();

            $teamsData[] = [
                'team_name' => $team->name,
                'status' => $log->status,
                'registration_date' => Carbon::parse($log->created_at)->format('d M, Y'),
                'members' => $memberDetails
            ];
        }

        $pdf = Pdf::loadView('pdf.participant_list_report', [
            'fest' => $fest,
            'event' => $event,
            'teamsData' => $teamsData,
            'totalTeams' => count($teamsData),
            'totalParticipants' => $totalParticipants,
            'generatedAt' => now()->format('d M, Y')
        ])->setPaper('A4', 'portrait');

        $safeFest = preg_replace('/[^A-Za-z0-9_\-]/', '_', $fest->title);
        $safeEvent = preg_replace('/[^A-Za-z0-9_\-]/', '_', $event->title);

        return $pdf->download("participant_list_{$safeFest}_{$safeEvent}.pdf");
    }



    public function generateSummaryReport($festId)
    {
        $fest = Fest::findOrFail($festId);
        $events = Event::where('fest_id', $festId)->get();
        $reportData = [];
        $genderCounts = [];

        foreach ($events as $event) {
            $logs = EventRegistrationLog::where('event_id', $event->id)->where('status', 'Approved')->get();
            $teamIds = $logs->pluck('team_id')->unique()->toArray();

            $participants = TeamMember::whereIn('team_id', $teamIds)->get();
            $userIds = $participants->pluck('user_id')->unique()->toArray();
            $infos = UserInfo::whereIn('user_id', $userIds)->get()->groupBy('gender');

            $femaleCount = isset($infos['girl']) ? count($infos['girl']) : 0;
            $maleCount = isset($infos['boy']) ? count($infos['boy']) : 0;

            $regFee = floatval(preg_replace('/[^\\d.]/', '', $event->registration_fee ?? '0'));
            $teamCount = count($teamIds);
            $participantCount = $participants->count();
            $totalCollected = $regFee * $teamCount;
            $charge = $totalCollected * 0.018;
            $netCollected = $totalCollected - $charge;

            $reportData[] = [
                'event' => $event,
                'registration_fee' => $regFee,
                'teamCount' => $teamCount,
                'participantCount' => $participantCount,
                'total_collected' => $totalCollected,
                'charge' => $charge,
                'net_collected' => $netCollected,
            ];

            $genderCounts[] = [
                'event' => $event->title,
                'girl' => $femaleCount,
                'boy' => $maleCount,
            ];
        }

        $pdf = Pdf::loadView('pdf.final_festival_report', [
            'fest' => $fest,
            'reportData' => $reportData,
            'genderCounts' => $genderCounts,
        ])->setPaper('A4', 'portrait');

        $safeFest = preg_replace('/[^A-Za-z0-9_\\-]/', '_', $fest->title);
        return $pdf->download("summary_report_{$safeFest}.pdf");
    }



    // Batch Wise Report
    public function generateBatchCountReport($festId)
    {
        $fest = Fest::findOrFail($festId);
        $events = Event::where('fest_id', $festId)->get();

        $batches = collect();
        $reportData = [];
        $totals = [];

        foreach ($events as $event) {
            $logs = EventRegistrationLog::where('event_id', $event->id)->where('status', 'Approved')->get();
            $teamIds = $logs->pluck('team_id')->unique();

            $members = TeamMember::whereIn('team_id', $teamIds)->get();
            $userIds = $members->pluck('user_id')->unique();

            $users = User::whereIn('id', $userIds)->get();
            $batchCount = [];

            foreach ($users as $user) {
                $batchPrefix = substr($user->student_id, 0, 2);
                if (!ctype_digit($batchPrefix)) continue;

                $batch = intval($batchPrefix);
                $batches->push($batch);
                $batchCount[$batch] = ($batchCount[$batch] ?? 0) + 1;
                $totals[$batch] = ($totals[$batch] ?? 0) + 1;
            }

            $reportData[] = [
                'event' => $event->title,
                'counts' => $batchCount,
                'total' => array_sum($batchCount),
            ];
        }

        $batches = $batches->unique()->sort()->values();
        $grandTotal = array_sum($totals);

        $pdf = Pdf::loadView('pdf.batch_count_report', [
            'fest' => $fest,
            'reportData' => $reportData,
            'batches' => $batches,
            'totals' => $totals,
            'grandTotal' => $grandTotal,
        ])->setPaper('A4', 'portrait');

        $safeFest = preg_replace('/[^A-Za-z0-9_\\-]/', '_', $fest->title);
        return $pdf->download("batch_count_report_{$safeFest}.pdf");
    }



    public function exportRegistrationQnAAsCSV($eventId)
    {
        $event = DB::table('events')->where('id', $eventId)->first();
        if (!$event) {
            abort(404, 'Event not found');
        }
    
        // Determine max team size
        $maxMembers = is_numeric($event->max_team_size) ? intval($event->max_team_size) : 6;
    
        // Load registration questions
        $questions = DB::table('registration_question_fields')
            ->where('event_id', $eventId)
            ->orderBy('id')
            ->get();
        $questionIds = $questions->pluck('id')->toArray();
    
        // CSV headers
        $csvHeaders = [
            'team_id', 'team_name',
            'team_lead_name', 'team_lead_email', 'team_lead_phone', 'team_lead_student_id',
        ];
    
        for ($i = 1; $i <= $maxMembers; $i++) {
            $csvHeaders = array_merge($csvHeaders, [
                "member_{$i}_name", "member_{$i}_email", "member_{$i}_phone",
                "member_{$i}_student_id", "member_{$i}_batch", "member_{$i}_university", "member_{$i}_gender"
            ]);
        }
    
        foreach ($questions as $q) {
            $csvHeaders[] = $q->question;
        }
    
        $teams = DB::table('event_registration_logs')
            ->where('event_id', $eventId)
            ->where('status', 'Approved')
            ->pluck('team_id');
    
        $rows = [];
    
        foreach ($teams as $teamId) {
            $team = DB::table('teams')->where('id', $teamId)->first();
            $lead = DB::table('users')->where('id', $team->team_lead)->first();
    
            $baseRow = [
                $team->id,
                $team->name,
                $lead->name,
                $lead->email,
                $lead->phone,
                $lead->student_id,
            ];
    
            $members = DB::table('team_members')
                ->where('team_id', $team->id)
                ->join('users', 'team_members.user_id', '=', 'users.id')
                ->leftJoin('user_infos', 'users.id', '=', 'user_infos.user_id')
                ->select(
                    'users.name', 'users.email', 'users.phone', 'users.student_id',
                    'users.university', 'user_infos.gender'
                )
                ->get();
    
            $memberFields = [];
            foreach ($members as $member) {
                $studentId = $member->student_id ?? '';
                $batch = ctype_digit(substr($studentId, 0, 2)) ? substr($studentId, 0, 2) : '';
                $memberFields = array_merge($memberFields, [
                    $member->name ?? '', $member->email ?? '', $member->phone ?? '',
                    $member->student_id ?? '', $batch,
                    $member->university ?? '', $member->gender ?? ''
                ]);
            }
    
            // Pad with blanks if member count < max
            $missing = $maxMembers - count($members);
            for ($i = 0; $i < $missing; $i++) {
                $memberFields = array_merge($memberFields, array_fill(0, 7, ''));
            }
    
            $answers = DB::table('event_reg_question_answers')
                ->where('team_id', $teamId)
                ->where('event_id', $eventId)
                ->get()
                ->keyBy('question_id');
    
            $answerRow = [];
            foreach ($questionIds as $qid) {
                $answerRow[] = $answers[$qid]->answer ?? '';
            }
    
            $rows[] = array_merge($baseRow, $memberFields, $answerRow);
        }
    
        // Create CSV in-memory
        $filename = 'event_registration_detailed.csv';
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
