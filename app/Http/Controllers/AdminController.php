<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fest;

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
}
