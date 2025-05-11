<?php

namespace App\Http\Controllers;

use App\Models\EventRegistrationLog;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Event;

class TeamController extends Controller
{
    public function showTeamPage()
    {
        if(!session('user_id')){
            return redirect('/404');
        }

        $teams = Team::where('team_lead', session('user_id'))
                     ->withCount('members')
                     ->get();

        $other_team_ids = TeamMember::where('user_id', session('user_id'))
                                        ->pluck('team_id')
                                        ->toArray();
        $other_teams = Team::whereIn('id', $other_team_ids)
                            ->withCount('members')
                            ->get();
        $teams = $teams->merge($other_teams);
        $teams = $teams->sortByDesc('created_at');
        $teams = $teams->values()->all();
        
        return view('frontend.team',[
            'teams' => $teams,
        ]);
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

        $team_member = new TeamMember();
        $team_member->user_id = session('user_id');
        $team_member->team_id = $team->id;
        $team_member->role = 'team-lead';
        $team_member->save();

        return redirect('/team/show/'.$team->id);
    }


    public function editTeam(Request $request)
    {
        if(!session('user_id')){
            return redirect('/404');
        }
        
        $request->validate([
            'team_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $team = Team::find($request->team_id);
        if(!$team){
            return redirect('/404');
        }

        if($team->team_lead != session('user_id')){
            return redirect('/404');
        }

        $team->name = $request->name;
        $team->color = $request->color;
        $team->description = $request->description;
        $team->save();

        return redirect()->back()->with('success', 'Team updated successfully');
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

        $team_members = TeamMember::where('team_id', $team_id)
                                  ->with('user')
                                  ->get();

        $user_emails = User::all(['id', 'email']);

        $events_where_team_is_participant = EventRegistrationLog::where('team_id', $team_id)
                                                                ->pluck('event_id')
                                                                ->toArray();
        
        $disable_add_member = false;

        foreach($events_where_team_is_participant as $event_id){
            $event = Event::find($event_id);
            if($event && \Carbon\Carbon::parse($event->end_date)->gt(now())){
                $disable_add_member = true;
                break;
            }
        }       

        $obejects = [
            'team' => $team,
            'team_members' => $team_members,
            'user_emails' => $user_emails,
            'disable_add_member' => $disable_add_member,
        ];

        return view('frontend.team_details',[
            'objects' => $obejects,
        ]);
    }



    public function addMember(Request $request)
    {
        if(!session('user_id')){
            return redirect('/404');
        }
        
        $request->validate([
            'email' => 'required|email',
            'team_id' => 'required|integer',
            'role' => 'required|string',
        ]);

        $team = Team::find($request->team_id);
        if(!$team){
            return redirect('/404');
        }

        if($team->team_lead != session('user_id')){
            return redirect('/404');
        }

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()->back()->withErrors(['email' => 'User not found']);
        }

        if(TeamMember::where('user_id', $user->id)->where('team_id', $request->team_id)->exists()){
            return redirect('/404');
        }

        $team_member = new TeamMember();
        $team_member->user_id = $user->id;
        $team_member->team_id = $request->team_id;
        $team_member->role = $request->role;
        $team_member->save();

        return redirect()->back()->with('success', 'Member added successfully');
    }


    public function removeMember(Request $request)
    {
        if(!session('user_id')){
            return redirect('/404');
        }
        
        $request->validate([
            'team_member_id' => 'required|integer',
            'team_id' => 'required|integer',
        ]);

        $team = Team::find($request->team_id);
        if(!$team){
            return redirect('/404');
        }

        if($team->team_lead != session('user_id')){
            return redirect('/404');
        }

        $team_member = TeamMember::where('id', $request->team_member_id)
                                 ->where('team_id', $request->team_id)
                                 ->first();
        if(!$team_member){
            return redirect('/404');
        }

        $team_member->delete();

        return redirect()->back()->with('success', 'Member removed successfully');
    }
}
