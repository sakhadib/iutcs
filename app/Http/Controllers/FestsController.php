<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FestsController extends Controller
{
    public function showFestsPage()
    {
        return view('frontend.fests');
    }

    public function festDetails($id)
    {
        return view('frontend.fest-details');
    }
}
