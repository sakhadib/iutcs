<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Team;

class TeamController extends Controller
{
    public function showTeamPage()
    {
        if(!session('user_id')){
            return redirect('/404');
        }
        
        return view('frontend.team');
    }

    public function showCreateTeamPage()
    {
        if(!session('user_id')){
            return redirect('/404');
        }
        
        return view('frontend.create_team');

    }


    public function storeTeam(Request $request)
    {
        if(!session('user_id')){
            return redirect('/404');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $team = new Team();
        $team->name = $request->name;
        $team->color = $request->color;
        $team->description = $request->description;
        $team->team_lead = session('user_id');
        $team->save();

        return redirect('/team/show/'.$team->id);
    }


    public function showTeamDetails($team_id)
    {
        if(!session('user_id')){
            return redirect('/404');
        }
        
        $team = Team::find($team_id);
        if(!$team){
            return redirect('/404');
        }

        // $members = User::where('team_id', $team_id)->get();

        return view('frontend.team_details',[
            'team' => $team,
            // 'members' => $members,
        ]);
    }
}
