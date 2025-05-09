<?php

namespace App\Http\Controllers;

use App\Models\Fest;
use App\Models\Event;
use App\Models\EventRegistrationLog;
use App\Models\EventRegQuestionAnswer;
use App\Models\RegistrationQuestionField;
use App\Models\Team;
use Illuminate\Http\Request;

class ParticipantRegisterController extends Controller
{
    public function registerParticipant(Request $request, $fest, $event){
        if(!session('user_id')){
            return redirect('/login');
        }
        
        $fest = Fest::where('id', $fest)->first();
        if(!$fest) {
            return redirect('/404');
        }

        $event = Event::where('id', $event)
                    ->where('fest_id', $fest->id)
                    ->withCount(['participants'])
                    ->first();
        if(!$event) {
            return redirect('/404');
        }
        
        // Validate team selection
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);
        
        // Check team ownership
        $team = Team::find($request->team_id);
        if (!$team || $team->team_lead != session('user_id')) {
            return redirect()->back()->withErrors(['team_id' => 'You must select a team you lead.']);
        }
        
        // Get all questions for this event to validate answers
        $questions = RegistrationQuestionField::where('event_id', $event->id)->get();
        
        // Build validation rules for questions
        $validationRules = [];
        foreach ($questions as $question) {
            $fieldName = 'question_' . $question->id;
            $validationRules[$fieldName] = 'required';
        }
        
        // Validate question answers
        $request->validate($validationRules);
        
        // Check if the user has already registered for this event with this team
        $existingRegistration = EventRegistrationLog::where('user_id', session('user_id'))
            ->where('event_id', $event->id)
            ->where('team_id', $request->team_id)
            ->first();
            
        if ($existingRegistration) {
            return redirect()->back()->withErrors(['general' => 'You have already registered for this event with this team.']);
        }
        
        // Create registration log
        $registration = new EventRegistrationLog();
        $registration->user_id = session('user_id');
        $registration->event_id = $event->id;
        $registration->team_id = $request->team_id;
        $registration->status = 'pending';
        $registration->save();
        
        // Save answers to questions
        foreach ($questions as $question) {
            $fieldName = 'question_' . $question->id;
            
            $answer = new EventRegQuestionAnswer();
            $answer->user_id = session('user_id');
            $answer->event_id = $event->id;
            $answer->question_id = $question->id;
            $answer->team_id = $request->team_id;
            $answer->answer = $request->input($fieldName);
            $answer->save();
        }
        
        return redirect('/fest/' . $fest->id . '/event/' . $event->id)
            ->with('success', 'Your registration for ' . $event->title . ' has been submitted successfully!');
    }
}
