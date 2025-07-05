<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CourseApplicationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Institute;

class CourseApplicationController extends Controller
{   

    public function showCategories()
{
    $posts = Post::with('institute')->get(); // eager load institute
    return view('frontend.categories', compact('posts'));
}

    public function apply(Request $request, $institute_id)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
            'course_title' => 'required|string',
        ]);

        // Get the institute by ID
        $institute = Institute::findOrFail($institute_id);

        // Send the mail
        Mail::to($institute->email)->send(new CourseApplicationMail($validated));

        return back()->with('success', 'Your application has been sent successfully.');
    }
}
