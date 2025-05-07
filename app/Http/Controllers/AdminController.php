<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Handle the creation of a new fest
        // Validate and save the fest data
        // Redirect or return a response
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
