<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showEventPage($fest, $event)
    {
        return view('frontend.event');
    }


    public function eventRegistration($fest, $event)
    {
        return view('frontend.event-reg');
    }
}
