<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;

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
        
        return view('frontend.fest-details',[
            'fest' => $fest
        ]);
    }
}
