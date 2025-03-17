<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Institute;
use App\Models\Category;
use App\Models\Post;
use App\Models\Event;


class ProfileController extends Controller
{
    // public function edit()
    // {
    //     $user = Auth::user();
    //     $categories = Category::all();
        

    //     // Check if the logged-in user is an institute
    //     if ($user->role === 'Institute') {
    //         $institute = Institute::where('email', $user->email)->first();
    //         return view('frontend.profile.institute-edit', compact('institute'));
    //     }
    //     $posts = $institute ? $institute->posts()->latest()->get() : collect();

    //     // Normal user profile view
    //     return view('frontend.profile.user-edit', compact('user', 'posts'));
    // }

    public function edit()
{
    $user = Auth::user();
    $categories = Category::all();
    $posts = collect(); // Default empty collection for posts
    $events = collect(); // Default empty collection for events
    $instituteId = Auth::user();

    // Check if the logged-in user is an institute
    if ($user->role === 'Institute') {
        $institute = Institute::where('email', $user->email)->first();

        // Get posts and events for the institute
        $posts = $institute ? $institute->posts()->latest()->get() : collect();
        $events = $institute ? $institute->events()->latest()->get() : collect();

        return view('frontend.profile.institute-edit', compact('institute', 'posts', 'events', 'categories'));
    }

    // Normal user profile view - no posts or events
    return view('frontend.profile.user-edit', compact('user', 'posts', 'events'));
}




    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'Institute') {
            // Institute-specific update logic
            $request->validate([
                'institute_name' => 'required|string|max:255',
                'location' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'bio' => 'nullable|string|max:255',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $institute = Institute::where('email', $user->email)->first();
            $institute->update($request->only(['institute_name', 'location', 'bio']));

            if ($request->hasFile('profile_photo')) {
                if ($institute->profile_photo) {
                    Storage::delete('public/' . $institute->profile_photo);
                }
                $institute->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
            }

            if ($request->hasFile('cover_photo')) {
                if ($institute->cover_photo) {
                    Storage::delete('public/' . $institute->cover_photo);
                }
                $institute->cover_photo = $request->file('cover_photo')->store('cover_photos', 'public');
            }

            $institute->save();

        } else {
            // Normal user-specific update logic
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user->update($request->only(['name', 'email']));

            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture from storage if exists
                if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
                    Storage::delete('public/' . $user->profile_picture);
                }
    
                // Store the new profile picture
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $user->profile_picture = $path; // Save the path in the database
            }
    
            $user->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
{
    // Validate input fields
    $validator = Validator::make($request->all(), [
        'current_password' => 'required|string',
        'new_password' => 'required|string|confirmed|min:8',
    ]);

    // If validation fails, return errors
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Check if the current password matches the logged-in user's password
    if (!Hash::check($request->current_password, Auth::user()->password)) {
        // If the current password is wrong
        return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
    }

    // Check if new password and confirm password match
    if ($request->new_password !== $request->new_password_confirmation) {
        // If new password and confirmation do not match
        return back()->withErrors(['new_password' => 'The new password and confirmation password do not match.'])->withInput();
    }

    // Update password
    $user = Auth::user();
    $user->password = Hash::make($request->new_password);
    $user->save();

    // Redirect with success message
    return back()->with('success', 'Password updated successfully!');
}


    public function destroy()
    {
        $user = Auth::user();
        if ($user->profile_picture) {
            Storage::delete('public/' . $user->profile_picture);
        }
        $user->delete();

        return redirect()->route('home')->with('success', 'Account deleted successfully.');
    }


    
}


