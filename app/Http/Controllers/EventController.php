<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;
use App\Models\EventRegistrationLog;
use App\Models\RegistrationQuestionField;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;

class EventController extends Controller
{
    public function showEventPage($fest, $event)
    {
        $festival = Fest::where('id', $fest)->first();

        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->withCount(['participants'])
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
        }

        $status = null;

        if(session('user_id')) {
            $me = User::where('id', session('user_id'))->first();
            if(!$me) {
                return redirect('/404');
            }

            $team_ids = TeamMember::where('user_id', session('user_id'))
                        ->pluck('team_id')
                        ->toArray();
            $team_ids = array_unique($team_ids);
            $team_ids = array_values($team_ids);

            $reg_log = EventRegistrationLog::where('event_id', $event)
                        ->whereIn('team_id', $team_ids)
                        ->first();

            if($reg_log) {
                $status = $reg_log->status;
            } else {
                $status = null;
            }
        } else {
            $me = null;
        }

        $object = [
            'fest' => $festival,
            'event' => $fullevent,
            'status' => $status,
        ];
        
        // $json_object = json_encode($object);
        // die($json_object);
        
        return view('frontend.event',[
            'object' => $object,
        ]);
    }


    public function eventRegistration($fest, $event)
    {
        $festival = Fest::where('id', $fest)->first();
        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->withCount(['participants'])
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
        }

        $me = User::where('id', session('user_id'))->first();
        if(!$me) {
            return redirect('/404');
        }

        $my_teams = Team::where('team_lead', session('user_id'))
                    ->withCount(['members'])
                    ->get();


        $questions = RegistrationQuestionField::where('event_id', $event)
                                              ->get();
        
        
        return view('frontend.event-reg',[
            'fest' => $festival,
            'event' => $fullevent,
            'me' => $me,
            'my_teams' => $my_teams,
            'questions' => $questions,
        ]);
    }
}
