<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function showPage()
    {
        return view('frontend.signup');
    }
}
