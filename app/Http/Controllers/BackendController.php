<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Institute;
use App\Models\Post;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Validator; 

class BackendController extends Controller
{
    public function admindash()
{
    if (auth()->user()->role !== 'Admin') {
        abort(403, 'Unauthorized access');
    }

    $userCount = User::count(); // Count the total number of users
    $instituteCount = Institute::count(); // Count the total number of institutes
    $postCount = Post::count(); // Count the total number of posts
    $eventCount = Event::count(); // Count the total number of events

    return view('admin.admindash', compact('userCount', 'instituteCount', 'postCount', 'eventCount'));
}



    public function index()
    {
        $users = User::all(); // Fetch all users from the database
        return view('admin.users', compact('users')); // Pass users to the view
    }
    


    // Method to update user data
    public function update(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'role' => 'required|string|in:Admin,User,Institute',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        // Find the user by ID and update their details
        $user = User::find($request->id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();

            // Return a success response
            return response()->json(['success' => true, 'user' => $user]);
        }

        // Return failure response if user is not found
        return response()->json(['success' => false, 'message' => 'User not found']);
    }

    public function destroy($id)
{
    try {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('admin.users')->with('error', 'Failed to delete user.');
    }
}



public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'role' => 'required|string',
        'password' => 'required|string|min:8',
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'role' => $validatedData['role'],
        'password' => bcrypt($validatedData['password']),
    ]);

    return response()->json(['success' => true, 'user' => $user]);
}







}

