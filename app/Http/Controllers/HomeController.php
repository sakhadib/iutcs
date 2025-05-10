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

        if ($recentFest) {
            $event_count = Event::where('fest_id', $recentFest->id)
                            ->count();
        }
        else{
            $event_count = 0;
        }
        
        return view('frontend.home',[
            'featuredFest' => $recentFest,
            'event_count' => $event_count,
        ]);
    }


    public function showAboutPage()
    {
        return view('frontend.about');
    }
}
