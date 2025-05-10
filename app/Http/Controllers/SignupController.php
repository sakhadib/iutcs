<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\userInfo;

class SignupController extends Controller
{
    public function showPage()
    {
        return view('frontend.signup');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'studentID' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'university' => 'required|string|max:255',
            'batch' => 'required|string|max:4',
            'bio' => 'required|string|max:500',
            'website' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'gender' => 'required|in:boy,girl',
            'address' => 'required|string|max:255',
        ]);

        // Create and save User
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->student_id = $validated['studentID'];
        $user->password = md5($validated['password']);
        $user->phone = $validated['phone'];
        $user->university = $validated['university'];
        $user->batch = $validated['batch'];
        $user->save();

        // Create and save UserInfo
        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->bio = $validated['bio'];
        $userInfo->website = $validated['website'];
        $userInfo->linkedin = $validated['linkedin'];
        $userInfo->github = $validated['github'];
        $userInfo->gender = $validated['gender'];
        $userInfo->address = $validated['address'];
        $userInfo->save();

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }
}
