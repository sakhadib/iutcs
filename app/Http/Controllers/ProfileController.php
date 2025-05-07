<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ProfileController extends Controller
{
    public function viewProfile($user_id)
    {
        // Fetch user data from the database using the user_id
        $user = User::where('id', $user_id)
                    ->with(['userInfo'])
                    ->first();

        if (!$user) {
            return redirect('/home')->with('error', 'User not found.');
        }

        // Pass the user data to the profile view
        return view('frontend.profile', 
                [
                    'user' => $user
                ]);
    }
}
