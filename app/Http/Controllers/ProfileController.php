<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\userInfo;

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

        $userInfo = userInfo::where('user_id', $user_id)
                    ->first();

        $team_count = TeamMember::where('user_id', $user_id)
                    ->count();

        // Pass the user data to the profile view
        return view('frontend.profile', 
        [
            'user' => $user,
            'userInfo' => $userInfo,
            'team_count' => $team_count,
        ]);
    }
}
