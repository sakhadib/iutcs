<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;
use App\Models\RegistrationQuestionField;
use App\Models\Team;
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

        $object = [
            'fest' => $festival,
            'event' => $fullevent,
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
