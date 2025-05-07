<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class SignupController extends Controller
{
    public function showPage()
    {
        return view('frontend.signup');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'studentID' => 'required|string|max:255',
        ]);

        // Create a new user instance
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->student_id = $request->input('studentID');
        $user->password = md5($request->input('password'));

        if($request->input('phone')) {
            $user->phone = $request->input('phone');
        }
        if($request->input('university')) {
            $user->university = $request->input('university');
        }
        if($request->input('batch')) {
            $user->batch = $request->input('batch');
        }

        $user->save();

        // Redirect to the login page with a success message
        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }
}
