<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $recentFest = Fest::orderBy('created_at', 'desc')
                          ->first();

        $event_count = Event::where('fest_id', $recentFest->id)
                          ->count();
        
        return view('frontend.home',[
            'featuredFest' => $recentFest,
            'event_count' => $event_count,
        ]);
    }
}
