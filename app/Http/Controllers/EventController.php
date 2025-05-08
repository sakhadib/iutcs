<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;

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
        return view('frontend.event-reg');
    }
}
