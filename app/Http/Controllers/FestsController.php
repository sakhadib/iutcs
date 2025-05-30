<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;   

class FestsController extends Controller
{
    public function showFestsPage()
    {
        $ongoing_fest = Fest::orderBy('created_at', 'desc')
                            ->where('end_date', '>=', now())
                            ->withCount('events')
                            ->first();
        
        return view('frontend.fests',
        [
            'ongoing_fest' => $ongoing_fest
        ]);
    }

    public function festDetails($fest_id)
    {
        $fest = Fest::where('id', $fest_id)
                    ->with(['events'])
                    ->first();

        if( !$fest) {
            return redirect('/404');
        }

        $events = Event::where('fest_id', $fest_id)
                    ->orderBy('created_at', 'desc')
                    ->get([
                        'id',
                        'title',
                        'start_date',
                        'end_date',
                        'location',
                        'medium',
                        'registration_fee',
                        'max_team_size',
                        'min_team_size',
                        'image'
                    ]);
        
        return view('frontend.fest-details',[
            'fest' => $fest,
            'events' => $events
        ]);
    }
}
