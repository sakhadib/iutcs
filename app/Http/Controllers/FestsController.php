<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;
use App\Models\EventImage;

class FestsController extends Controller
{
    public function showFestsPage()
    {
        $currentDate = now();
        
        // Get ongoing fests (where fest is currently running OR has at least one event currently running)
        $ongoing_fests = Fest::where(function($query) use ($currentDate) {
            // Fest itself is ongoing
            $query->where('start_date', '<=', $currentDate)
                  ->where(function($q) use ($currentDate) {
                      $q->whereNull('end_date')
                        ->orWhere('end_date', '>=', $currentDate);
                  });
        })
        ->orWhereHas('events', function($query) use ($currentDate) {
            // OR has events currently running
            $query->where('start_date', '<=', $currentDate)
                  ->where('end_date', '>=', $currentDate);
        })
        ->withCount('events')
        ->with(['events' => function($query) {
            $query->select('fest_id', 'start_date', 'end_date')
                  ->orderBy('start_date', 'asc');
        }])
        ->orderBy('created_at', 'desc')
        ->get();
        
        // Get upcoming fests (fest starts in the future AND all events start in the future)
        $upcoming_fests = Fest::where('start_date', '>', $currentDate)
        ->withCount('events')
        ->with(['events' => function($query) {
            $query->select('fest_id', 'start_date', 'end_date')
                  ->orderBy('start_date', 'asc');
        }])
        ->orderBy('start_date', 'asc')
        ->get();
        
        // Get past fests (fest has ended AND all events have ended)
        $past_fests = Fest::where(function($query) use ($currentDate) {
            $query->where('end_date', '<', $currentDate)
                  ->orWhere(function($q) use ($currentDate) {
                      $q->where('start_date', '<', $currentDate)
                        ->whereNull('end_date')
                        ->whereDoesntHave('events', function($eventQuery) use ($currentDate) {
                            $eventQuery->where('end_date', '>=', $currentDate);
                        });
                  });
        })
        ->withCount('events')
        ->with(['events' => function($query) {
            $query->select('fest_id', 'start_date', 'end_date')
                  ->orderBy('start_date', 'asc');
        }])
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
        
        return view('frontend.fests', [
            'ongoing_fests' => $ongoing_fests,
            'upcoming_fests' => $upcoming_fests,
            'past_fests' => $past_fests
        ]);
    }

    public function festDetails($fest_id)
    {
        $fest = Fest::where('id', $fest_id)
                    ->first();

        if( !$fest) {
            return redirect('/404');
        }

        $events = Event::where('fest_id', $fest_id)
                    ->orderBy('created_at', 'asc')
                    ->get([
                        'id',
                        'title',
                        'description',
                        'start_date',
                        'end_date',
                        'location',
                        'medium',
                        'registration_fee',
                        'max_team_size',
                        'min_team_size',
                        'image'
                    ]);

        $event_ids = $events->pluck('id')->toArray();

        $fest_images = EventImage::whereIn('event_id', $event_ids)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('frontend.fest-details',[
            'fest' => $fest,
            'events' => $events,
            'fest_images' => $fest_images
        ]);
    }
}
