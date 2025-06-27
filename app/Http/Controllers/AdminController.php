<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;
use App\Models\EventRegistrationLog;
use App\Models\EventRegQuestionAnswer;
use App\Models\RegistrationQuestionField;
use App\Models\Team;
use App\Models\User;
use App\Models\TeamMember;

class AdminController extends Controller
{
    public function showCreateFestPage()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }
        return view('admin.create_fest');
    }

    public function createFest(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'medium' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload if needed
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'fest/' . $imageName;
            $image->move(public_path('fest'), $imageName);
        }

        $fest = new Fest();
        $fest->title = $request->input('title');
        $fest->description = $request->input('description');
        $fest->start_date = $request->input('start_date');
        $fest->end_date = $request->input('end_date');
        $fest->medium = $request->input('medium');
        $fest->location = $request->input('location');
        $fest->image = $imagePath ? asset($imagePath) : null; // Store full path
        $fest->created_by = session('user_id');
        $fest->save();

        return redirect('/admin/fests/create')->with('success', 'Fest created successfully!');
    }

    public function showEditFestPage($festId)
    {
        // Fetch the fest data using $festId
        // Return the edit fest view with the fest data
    }

    public function updateFest(Request $request, $festId)
    {
        // Handle the update of the fest
        // Validate and save the updated fest data
        // Redirect or return a response
    }



    // Create Event
    public function showCreateEventPage($festId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $fest = Fest::find($festId);
        if (!$fest) {
            return redirect('/fests')->with('error', 'Fest not found.');
        }

        return view('admin.create_event', ['festId' => $festId, 'fest' => $fest]);
    }


    public function createEvent(Request $request, $festId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rules' => 'required|string',
            'rulebook_link' => 'nullable|url',
            'prizes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'registration_closing_date' => 'required|date',
            'registration_fee' => 'required|numeric|min:0',
            'max_team_size' => 'required|integer|min:1',
            'min_team_size' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'medium' => 'required|string|max:255',
            'judges' => 'nullable|string',
            'registration_link' => 'nullable|url',
            'contact' => 'nullable|string',
        ]);

        // Handle file upload if needed
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'event/' . $imageName;
            $image->move(public_path('event'), $imageName);
        }

        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->rules = $request->input('rules');
        $event->rulebook_link = $request->input('rulebook_link');
        $event->prizes = $request->input('prizes');
        $event->image = $imagePath ? asset($imagePath) : null; // Store full path
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->registration_closing_date = $request->input('registration_closing_date');
        $event->registration_fee = $request->input('registration_fee');
        $event->max_team_size = $request->input('max_team_size');
        $event->min_team_size = $request->input('min_team_size');
        $event->location = $request->input('location');
        $event->medium = $request->input('medium');
        $event->judges = $request->input('judges');
        $event->registration_link = $request->input('registration_link');
        $event->contact = $request->input('contact');
        $event->fest_id = $festId;

        $event->save();



        return redirect('/fest/'. $festId .'/event/'. $event->id);
    }



    // Form Builder
    public function showFormBuilderPage($festId, $eventId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $fest = Fest::find($festId);
        if (!$fest) {
            return redirect('/404')->with('error', 'Fest not found.');
        }

        $event = Event::find($eventId);
        if (!$event) {
            return redirect('/404')->with('error', 'Event not found.');
        }
        if ($event->fest_id != $festId) {
            return redirect('/404')->with('error', 'Event does not belong to this fest.');
        }

        // Fetch existing questions for the event
        $questions = RegistrationQuestionField::where('event_id', $eventId)->get();

        return view('admin.form_builder', ['fest' => $fest, 'event' => $event, 'questions' => $questions]);
    }


    public function addQuestion(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|string|in:text,radio,checkbox',
            'options' => 'nullable|string',
        ]);

        $question = new RegistrationQuestionField();
        $question->question = $request->input('question');
        $question->type = $request->input('type');
        $question->options = $request->input('options');
        $question->event_id = $request->input('event_id');

        // Handle the logic for saving the question to the database
        $question->save();        

        return redirect()->back()->with('success', 'Question added successfully!');
    }


    public function deleteQuestion($questionId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $question = RegistrationQuestionField::find($questionId);
        if ($question) {
            $question->delete();
            return redirect()->back()->with('success', 'Question deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Question not found.');
        }
    }



    public function ShowParticipantsPage($festId, $eventId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $fest = Fest::find($festId);
        if (!$fest) {
            return redirect('/404')->with('error', 'Fest not found.');
        }

        $event = Event::find($eventId);
        if (!$event) {
            return redirect('/404')->with('error', 'Event not found.');
        }
        if ($event->fest_id != $festId) {
            return redirect('/404')->with('error', 'Event does not belong to this fest.');
        }

        $regLogs = EventRegistrationLog::where('event_id', $eventId)->get();
        $participant_teams = [];

        foreach($regLogs as $log){
            $team = Team::where('id', $log->team_id)
                        ->with(['leader', 'members'])
                        ->first();
            
            if ($team) {
                $team->registration_log = $log;
                $team->members = $team->members->map(function ($member) {
                    return [
                        'id' => $member->user->id, // Add this line
                        'name' => $member->user->name,
                        'email' => $member->user->email,
                    ];
                });
                $participant_teams[] = $team;
            }
        }

        return view('admin.participants', [
            'fest' => $fest,
            'event' => $event,
            'teams' => $participant_teams,
        ]);
    }


    public function individualTeamDetails($festId, $eventId, $teamId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $fest = Fest::find($festId);
        if (!$fest) {
            return redirect('/404')->with('error', 'Fest not found.');
        }

        $event = Event::find($eventId);
        if (!$event) {
            return redirect('/404')->with('error', 'Event not found.');
        }
        if ($event->fest_id != $festId) {
            return redirect('/404')->with('error', 'Event does not belong to this fest.');
        }

        $team = Team::where('id', $teamId)
                    ->with(['leader', 'members'])
                    ->first();

        $reglog = EventRegistrationLog::where('team_id', $teamId)
                    ->where('event_id', $eventId)
                    ->first();

        $team->registration_log = $reglog;

        if (!$team) {
            return redirect('/404')->with('error', 'Team not found.');
        }

        $questions = RegistrationQuestionField::where('event_id', $eventId)->get();

        $ques = [];

        foreach($questions as $question)
        {
            $ans = EventRegQuestionAnswer::where('team_id', $teamId)
                        ->where('question_id', $question->id)
                        ->first();

            $object = [
                'question' => $question,
                'answer' => $ans ? $ans->answer : null,
            ];

            $ques[] = $object;
        }

        return view('admin.team_details', [
            'fest' => $fest,
            'event' => $event,
            'team' => $team,
            'questions' => $ques,
        ]);
    }



    public function approveTeam($festId, $eventId, $teamId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $team = Team::find($teamId);
        if (!$team) {
            return redirect('/404')->with('error', 'Team not found.');
        }

        $reglog = EventRegistrationLog::where('team_id', $teamId)
                    ->where('event_id', $eventId)
                    ->first();

        if(!$reglog)
        {
            return redirect('/404')->with('error', 'Registration log not found.');
        }

        $reglog->status = 'approved';
        $reglog->save();

        return redirect()->back()->with('success', 'Team approved successfully!');
    }


    public function rejectTeam($festId, $eventId, $teamId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $team = Team::find($teamId);
        if (!$team) {
            return redirect('/404')->with('error', 'Team not found.');
        }

        $reglog = EventRegistrationLog::where('team_id', $teamId)
                    ->where('event_id', $eventId)
                    ->first();

        if(!$reglog)
        {
            return redirect('/404')->with('error', 'Registration log not found.');
        }

        $reglog->status = 'rejected';
        $reglog->save();

        return redirect()->back()->with('success', 'Team rejected successfully!');
    }



    public function showAllUserPage(){
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $users = User::all();

        return view('admin.all_users', ['users' => $users]);
    }



    public function AddAdmin($userId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect('/404')->with('error', 'User not found.');
        }

        $user->role = 'admin';
        $user->save();

        return redirect('/admin/users');
    }



    public function RemoveAdmin($userId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect('/404')->with('error', 'User not found.');
        }

        $user->role = 'user';
        $user->save();

        return redirect('/admin/users');
    }
    





}
