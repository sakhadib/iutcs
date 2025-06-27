<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Fest;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\EventRegistrationLog;
use App\Models\RegistrationQuestionField;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\User;

class EventController extends Controller
{
    public function showEventPage($fest, $event)
    {
        $festival = Fest::where('id', $fest)->first();

        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->withCount(['participants'])
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
        }

        $status = null;

        if(session('user_id')) {
            $me = User::where('id', session('user_id'))->first();
            if(!$me) {
                return redirect('/404');
            }

            $team_ids = TeamMember::where('user_id', session('user_id'))
                        ->pluck('team_id')
                        ->toArray();
            $team_ids = array_unique($team_ids);
            $team_ids = array_values($team_ids);

            $reg_log = EventRegistrationLog::where('event_id', $event)
                        ->whereIn('team_id', $team_ids)
                        ->first();

            if($reg_log) {
                $status = $reg_log->status;
            } else {
                $status = null;
            }
        } else {
            $me = null;
        }

        $object = [
            'fest' => $festival,
            'event' => $fullevent,
            'status' => $status,
        ];
        
        // $json_object = json_encode($object);
        // die($json_object);
        
        return view('frontend.event',[
            'object' => $object,
        ]);
    }


    public function eventRegistration($fest, $event)
    {
        // return redirect('/404');

        // return redirect('/registration/close');

        $festival = Fest::where('id', $fest)->first();
        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->withCount(['participants'])
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
        }

        $me = User::where('id', session('user_id'))->first();
        if(!$me) {
            return redirect('/login');
        }

        $my_teams = Team::where('team_lead', session('user_id'))
                    ->withCount(['members'])
                    ->get();


        $questions = RegistrationQuestionField::where('event_id', $event)
                                              ->get();
        
        
        return view('frontend.event-reg',[
            'fest' => $festival,
            'event' => $fullevent,
            'me' => $me,
            'my_teams' => $my_teams,
            'questions' => $questions,
        ]);
    }


    public function editEvent($fest, $event)
    {
        $me = User::where('id', session('user_id'))->first();
        if(!$me || !$me->role == 'admin') {
            return redirect('/404');
        }
        
        $festival = Fest::where('id', $fest)->first();
        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->with('eventImages')
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
        }

        return view('admin.edit_event',[
            'fest' => $festival,
            'event' => $fullevent,
            'festId' => $fest,
            'eventId' => $event,
        ]);
    }




    public function updateEvent(Request $request, $fest, $event)
    {
        $me = User::where('id', session('user_id'))->first();
        if(!$me || !$me->role == 'admin') {
            return redirect('/404');
        }

        $festival = Fest::where('id', $fest)->first();
        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
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

            if($fullevent->image) {
                $oldImagePath = str_replace(url('/'), '', $fullevent->image);
                if (file_exists(public_path($oldImagePath))) {
                    unlink(public_path($oldImagePath));
                }
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'event/' . $imageName;
            $image->move(public_path('event'), $imageName);
        }
        else {
            // If no new image is uploaded, keep the old image path
            $imagePath = str_replace(url('/'), '', $fullevent->image);
        }

        $fullevent->title = $request->input('title');
        $fullevent->description = $request->input('description');
        $fullevent->rules = $request->input('rules');
        $fullevent->rulebook_link = $request->input('rulebook_link');
        $fullevent->prizes = $request->input('prizes');
        $fullevent->image = $imagePath ? asset($imagePath) : null; // Store full path
        $fullevent->start_date = $request->input('start_date');
        $fullevent->end_date = $request->input('end_date');
        $fullevent->registration_closing_date = $request->input('registration_closing_date');
        $fullevent->registration_fee = $request->input('registration_fee');
        $fullevent->max_team_size = $request->input('max_team_size');
        $fullevent->min_team_size = $request->input('min_team_size');
        $fullevent->location = $request->input('location');
        $fullevent->medium = $request->input('medium');
        $fullevent->judges = $request->input('judges');
        $fullevent->registration_link = $request->input('registration_link');
        $fullevent->contact = $request->input('contact');

        $fullevent->save();


        return redirect('/fest/'.$fest.'/event/'.$event)
            ->with('success', 'Event updated successfully.');

    }

    public function manageEventImages($fest, $event)
    {
        $me = User::where('id', session('user_id'))->first();
        if(!$me || !$me->role == 'admin') {
            return redirect('/404');
        }

        $festival = Fest::where('id', $fest)->first();
        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->with('eventImages')
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
        }

        return view('admin.manage_event_images',[
            'fest' => $festival,
            'event' => $fullevent,
            'festId' => $fest,
            'eventId' => $event,
        ]);
    }

    public function uploadEventImages(Request $request, $fest, $event)
    {
        // Debug: Check if request is coming through
        Log::info('Upload request received', [
            'fest' => $fest,
            'event' => $event,
            'has_file' => $request->hasFile('image'),
            'user_id' => session('user_id')
        ]);

        $me = User::where('id', session('user_id'))->first();
        if(!$me || $me->role != 'admin') {
            Log::info('Access denied', ['user' => $me ? $me->role : 'no user']);
            return redirect('/404');
        }

        $festival = Fest::where('id', $fest)->first();
        if(!$festival) {
            return redirect('/404');
        }

        $fullevent = Event::where('id', $event)
                    ->where('fest_id', $fest)
                    ->first();
        if(!$fullevent) {
            return redirect('/404');
        }

        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'caption' => 'nullable|string|max:255',
            ]);
        } catch (\Exception $e) {
            Log::error('Validation failed', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['image' => 'Image validation failed: ' . $e->getMessage()]);
        }

        $maxSortOrder = EventImage::where('event_id', $event)->max('sort_order') ?? 0;

        if ($request->hasFile('image')) {
            try {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'eventimage/' . $imageName;
                
                // Create directory if it doesn't exist
                $fullPath = public_path('eventimage');
                if (!file_exists($fullPath)) {
                    mkdir($fullPath, 0755, true);
                }
                
                // Move the uploaded file
                $image->move($fullPath, $imageName);

                // Create database record
                $eventImage = EventImage::create([
                    'event_id' => $event,
                    'image_path' => $imagePath,
                    'original_name' => $image->getClientOriginalName(),
                    'alt_text' => $request->caption ?? null,
                    'caption' => $request->caption ?? null,
                    'sort_order' => $maxSortOrder + 1,
                    'is_featured' => false,
                ]);

                Log::info('Image uploaded successfully', ['image_id' => $eventImage->id]);
                return redirect()->back()->with('success', 'Image uploaded successfully to the gallery!');
                
            } catch (\Exception $e) {
                Log::error('Image upload failed', ['error' => $e->getMessage()]);
                return redirect()->back()->with('error', 'Image upload failed: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'No image file was uploaded.');
    }

    public function deleteEventImage($imageId)
    {
        $me = User::where('id', session('user_id'))->first();
        if(!$me || !$me->role == 'admin') {
            return redirect('/404');
        }

        $eventImage = EventImage::find($imageId);
        if(!$eventImage) {
            return redirect()->back()->with('error', 'Image not found');
        }

        // Delete the physical file
        $imagePath = public_path($eventImage->image_path);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $eventImage->delete();

        return redirect()->back()->with('success', 'Gallery image deleted successfully');
    }

    public function toggleFeaturedImage($imageId)
    {
        $me = User::where('id', session('user_id'))->first();
        if(!$me || !$me->role == 'admin') {
            return redirect('/404');
        }

        $eventImage = EventImage::find($imageId);
        if(!$eventImage) {
            return redirect()->back()->with('error', 'Image not found');
        }

        $eventImage->is_featured = !$eventImage->is_featured;
        $eventImage->save();

        $status = $eventImage->is_featured ? 'featured' : 'unfeatured';
        return redirect()->back()->with('success', "Image marked as $status successfully");
    }

    public function updateImageOrder(Request $request, $imageId)
    {
        $me = User::where('id', session('user_id'))->first();
        if(!$me || !$me->role == 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $eventImage = EventImage::find($imageId);
        if(!$eventImage) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        $request->validate([
            'sort_order' => 'required|integer|min:0'
        ]);

        $eventImage->sort_order = $request->sort_order;
        $eventImage->save();

        return response()->json(['success' => true, 'message' => 'Image order updated']);
    }
}
