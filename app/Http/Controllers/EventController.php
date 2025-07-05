<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Institute;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::where('event_date', '>=', now())
                        ->orderBy('event_date', 'asc')
                        ->get();

        return view('frontend.events.upcoming', compact('events'));
    }



    public function create($id)
{
    // Fetch the institute by ID
    $institute = Institute::findOrFail($id);

    // Fetch all institutes (or you can filter them as needed)
    $institutes = Institute::all(); // Adjust based on your logic

    // Fetch all categories for dropdowns
    $categories = Category::all();

    // Pass institute, institutes, and categories to the view
    return view('frontend.profile.add-post', compact('institute', 'institutes', 'categories'));
}

    public function store(Request $request, $id)
    {
        $request->validate([
            'event_title' => 'required|string|max:255',
            'event_image' => 'required|image|max:2048',
            'event_description' => 'required|string',
            'event_date' => 'required|date',
            'main_location' => 'required|string',
            'sub_location' => 'required|string',
        ]);

        // Get the logged-in user's institute ID
        $instituteId = Auth::user()->institute->id;

        // Handle the image upload
        $eventImagePath = $request->file('event_image')->store('event_images', 'public');

        // Store the event data
        Event::create([
            'institute_id' => $id,
            'event_title' => $request->event_title,
            'event_description' => $request->event_description,
            'event_image' => $eventImagePath,
            'event_date' => $request->event_date,
            'main_location' => $request->main_location,
            'sub_location' => $request->sub_location,
        ]);

          // Get the logged-in user's institute and ID
    $userInstituteId = Auth::user()->institute_id;
    $userId = Auth::id();

    

    // Create a single notification for the post (exclude the creator from receiving the notification)
    Notification::create([
        'title' => 'New Post Added',
        'message' => 'An institute has added a new post about their program.',
        'type' => 'event', // or 'event' for events
        'created_by' => $userId, // The ID of the user who uploaded the post
        'institute_id' => $instituteId, // Institute that added the post
    ]);
    


        return redirect()->route('profile.edit', ['id' => $id])->with('success', 'Event created successfully!');
    }




    public function showEvent()
{
    // Fetch events and order by the event date
    $events = Event::with('institute')->latest()->get();

    // Fetch posts and order by the created date (adjust as needed)
    $posts = Post::with('institute')->orderBy('created_at', 'desc')->get();

    // Pass both posts and events to the view
    return view('frontend.feed.feed', compact('events', 'posts'));
}




public function adminEvents()
{
    // Fetch all events
    $events = Event::all();

    // Return the view with the events data
    return view('admin.events', compact('events'));
}



// Show the edit event form and return the event data as JSON
public function edit($id)
{
    $event = Event::findOrFail($id); // Fetch the event by ID or fail if not found
    return response()->json($event); // Return the event data as JSON
}

// Update the event in the database
public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);

    // Validate the request
    $request->validate([
        'event_title' => 'required|string|max:255',
        'event_description' => 'required|string',
        'event_date' => 'required|date',
        'sub_location' => 'nullable|string',
        'main_location' => 'nullable|string',
        'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update fields individually
    $event->event_title = $request->event_title;
    $event->event_description = $request->event_description;
    $event->event_date = $request->event_date;
    $event->sub_location = $request->sub_location;
    $event->main_location = $request->main_location;

    // Handle file upload
    if ($request->hasFile('event_image')) {
        $eventImagePath = $request->file('event_image')->store('event_images', 'public');
        $event->event_image = $eventImagePath;
    }

    // Save the event
    $event->save();

    return redirect()->back()->with('success', 'Event updated successfully.');
}



    
public function destroy($id)
{
    $event = Event::findOrFail($id);

    // Delete the associated image file if it exists
    if ($event->event_image && Storage::exists('public/' . $event->event_image)) {
        Storage::delete('public/' . $event->event_image);
    }

    // Delete the event
    $event->delete();

    return response()->json(['success' => true, 'message' => 'Event deleted successfully.']);
}

}
