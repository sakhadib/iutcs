<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;
use App\Models\Event;

class AdminController extends Controller
{
    public function showCreateFestPage()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }
        return view('admin.create_fest');
    }

    public function createFest(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'medium' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload if needed
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'fest/' . $imageName;
            $image->move(public_path('fest'), $imageName);
        }

        $fest = new Fest();
        $fest->title = $request->input('title');
        $fest->description = $request->input('description');
        $fest->start_date = $request->input('start_date');
        $fest->end_date = $request->input('end_date');
        $fest->medium = $request->input('medium');
        $fest->location = $request->input('location');
        $fest->image = $imagePath ? asset($imagePath) : null; // Store full path
        $fest->created_by = session('user_id');
        $fest->save();

        return redirect('/admin/fests/create')->with('success', 'Fest created successfully!');
    }

    public function showEditFestPage($festId)
    {
        // Fetch the fest data using $festId
        // Return the edit fest view with the fest data
    }

    public function updateFest(Request $request, $festId)
    {
        // Handle the update of the fest
        // Validate and save the updated fest data
        // Redirect or return a response
    }



    // Create Event
    public function showCreateEventPage($festId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $fest = Fest::find($festId);
        if (!$fest) {
            return redirect('/fests')->with('error', 'Fest not found.');
        }

        return view('admin.create_event', ['festId' => $festId, 'fest' => $fest]);
    }


    public function createEvent(Request $request, $festId)
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }
        if (session('role') !== 'admin') {
            return redirect('/home');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rules' => 'required|string',
            'rulebook_link' => 'nullable|url',
            'prizes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'registration_closing_date' => 'required|date',
            'registration_fee' => 'required|numeric|min:0',
            'max_team_size' => 'required|integer|min:1',
            'min_team_size' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'medium' => 'required|string|max:255',
            'judges' => 'nullable|string',
            'registration_link' => 'nullable|url',
            'contact' => 'nullable|string',
        ]);

        // Handle file upload if needed
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'event/' . $imageName;
            $image->move(public_path('event'), $imageName);
        }

        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->rules = $request->input('rules');
        $event->rulebook_link = $request->input('rulebook_link');
        $event->prizes = $request->input('prizes');
        $event->image = $imagePath ? asset($imagePath) : null; // Store full path
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->registration_closing_date = $request->input('registration_closing_date');
        $event->registration_fee = $request->input('registration_fee');
        $event->max_team_size = $request->input('max_team_size');
        $event->min_team_size = $request->input('min_team_size');
        $event->location = $request->input('location');
        $event->medium = $request->input('medium');
        $event->judges = $request->input('judges');
        $event->registration_link = $request->input('registration_link');
        $event->contact = $request->input('contact');
        $event->fest_id = $festId;

        $event->save();

        return redirect('/event/'. $event->id);
    }
}
