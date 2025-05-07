<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class LoginController extends Controller
{
    public function showLoginPage()
    {
        return view('frontend.login');
    }


    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email not found.']);
        }
        if (md5($request->password) !== $user->password) {
            return redirect()->back()->withErrors(['password' => 'Incorrect password.']);
        }

        // Check if the user is already logged in
        if (session()->has('user_id')) {
            return redirect('/home')->with('success', 'You are already logged in.');
        }

        // Store user ID in session
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'role' => $user->role,
        ]);

        // Redirect to the home page
        return redirect('/home')->with('success', 'Login successful.');
        
    }



    public function logout()
    {
        // Clear the session
        session()->flush();

        // Redirect to the login page
        return redirect('/login')->with('success', 'Logout successful.');
    }
}
