<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Institute;
use App\Models\Category;
use App\Models\Post;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class InstituteController extends Controller
{


    public function institutesmanage()
{
    $unapprovedInstitutes = Institute::where('status', 'unapproved')->get();
    $approvedInstitutes = Institute::where('status', 'approved')->get();

    return view('admin.institutesmanage', compact('unapprovedInstitutes', 'approvedInstitutes'));
}

    

public function approve($id)
{
    $institute = Institute::findOrFail($id);

    // Update the institute's status
    $institute->status = 'approved';
    $institute->save();

    return redirect()->route('admin.institutesmanage')->with('success', 'Institute approved successfully!');
}

    


public function instituteadd()
{
    return view('frontend.institutions.institutionprofileadd');
}


public function store(Request $request)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'institute_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'email' => 'required|email|unique:institutes',  // Ensure unique email
        'contact_number' => 'required|string|max:15',
        'gov_register_number' => 'required|string|max:255',
        'website' => 'nullable|url',
        'profile_photo' => 'nullable|image|max:2048',
        'cover_photo' => 'nullable|image|max:2048',
        'bio' => 'nullable|string|max:255',
        'password' => 'required|string|min:8|confirmed', // Ensure password is required and confirmed
    ]);

    // Create the user for login purposes
    $user = new User();
    $user->name = $validatedData['institute_name'];  // Use the institute name as the user's name
    $user->email = $validatedData['email'];
    $user->password = Hash::make($validatedData['password']); // Hash the password
    $user->role = 'Institute';  // Assign the role as 'institute'
    $user->save();  // Save user to the users table

    // Create the institute
    $institute = new Institute();
    $institute->institute_name = $validatedData['institute_name'];
    $institute->location = $validatedData['location'];
    $institute->email = $validatedData['email']; // Use the same email for institute
    $institute->contact_number = $validatedData['contact_number'];
    $institute->gov_register_number = $validatedData['gov_register_number'];
    $institute->website = $validatedData['website'];

    // Handle file uploads for profile photo and cover photo
    if ($request->hasFile('profile_photo')) {
        $institute->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
    }

    if ($request->hasFile('cover_photo')) {
        $institute->cover_photo = $request->file('cover_photo')->store('cover_photos', 'public');
    }

    // Optional: Set the bio if provided
    $institute->bio = $validatedData['bio'] ?? null;

    // Associate the institute with the user
    $institute->user_id = $user->id;  // Link the user to the institute

    // Save the institute data
    $institute->save();

    // Redirect or return a success message
    session()->flash('success', 'Institute registered successfully!');
    return redirect()->route('login');  // Redirect to the login page or wherever appropriate
}








public function show()
{
    $institutes = Institute::all(); // Fetch all institutes from the database
    return view('admin.institutesmanage', compact('institutes'));
}




public function destroy($id)
{
    $institute = Institute::findOrFail($id); // Find the institute or throw a 404 error
    $institute->delete(); // Delete the institute
    return response()->json(['success' => true, 'message' => 'Institute deleted successfully!']);
}




public function update(Request $request, $id)
{
    $institute = Institute::findOrFail($id);

    $validatedData = $request->validate([
        'institute_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'email' => 'required|email|unique:institutes,email,' . $id,
        'contact_number' => 'required|string|max:15',
        'gov_register_number' => 'required|string|max:255',
        'profile_photo' => 'nullable|image|max:2048',
        'cover_photo' => 'nullable|image|max:2048',
        'bio' => 'nullable|string',
        'website' => 'nullable|url',
        
    ]);

    $institute->update($validatedData);

    if ($request->hasFile('profile_photo')) {
        $institute->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
    }

    if ($request->hasFile('cover_photo')) {
        $institute->cover_photo = $request->file('cover_photo')->store('cover_photos', 'public');
    }

    $institute->save();

    return redirect()->back()->with('success', 'Institute updated successfully.');
}


// public function addinstitute(Request $request)
// {
//     // Validate the form data
//     $validatedData = $request->validate([
//         'institute_name' => 'required|string|max:255',
//         'location' => 'required|string|max:255',
//         'email' => 'required|email|unique:institutes',
//         'contact_number' => 'required|string|max:15',
//         'gov_register_number' => 'required|string|max:255',
//         'profile_photo' => 'nullable|image|max:2048',
//         'cover_photo' => 'nullable|image|max:2048',
//         'bio' => 'nullable|string|max:255',
//     ]);

//     // Create the new institute
//     $institute = new Institute();
//     $institute->institute_name = $validatedData['institute_name'];
//     $institute->location = $validatedData['location'];
//     $institute->email = $validatedData['email'];
//     $institute->contact_number = $validatedData['contact_number'];
//     $institute->gov_register_number = $validatedData['gov_register_number'];

//     // Handle file uploads
//     if ($request->hasFile('profile_photo')) {
//         $institute->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
//     }
//     if ($request->hasFile('cover_photo')) {
//         $institute->cover_photo = $request->file('cover_photo')->store('cover_photos', 'public');
//     }

//     $institute->bio = $validatedData['bio'];
//     $institute->save();

//     // Return a success response
//     return response()->json([
//         'success' => true,
//         'message' => 'Institute added successfully!',
//         'institute' => $institute,
//     ]);
// }


public function showInstitutions()
{
    $approvedInstitutes = Institute::where('status', 'approved')->get();
    return view('frontend.institutions.institutions', compact('approvedInstitutes'));
}


public function showProfile($id)
{
    // Fetch the institute by its ID
    $institute = Institute::findOrFail($id);
    $categories = Category::all();
    $events = collect();

    // Fetch the posts for this institute
    $posts = $institute->posts()->latest()->get(); // Assuming posts() relationship is defined
    $events = $institute ? $institute->events()->latest()->get() : collect();

    // Pass the institute data and posts to the profile view
    return view('frontend.profile.institute-edit', compact('institute', 'posts', 'events', 'categories'));
}








public function instituteupdate(Request $request, $id)
{
    if (Auth::user()->role !== 'admin' && Auth::user()->role === 'institute' && Auth::user()->id !== (int)$id) {
        abort(403, 'Unauthorized action.');
    }

    $institute = Institute::findOrFail($id);

    // Validate inputs
    $request->validate([
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'institute_name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('institutes', 'email')->ignore($id),
            Rule::unique('users', 'email')->ignore($institute->user_id),
        ],
        'contact_number' => 'required|string|max:15',
        'website' => 'nullable|url',
        'bio' => 'nullable|string|max:500',
    ]);

    // Update profile photo
    if ($request->hasFile('profile_photo')) {
        if ($institute->profile_photo) {
            Storage::delete('public/' . $institute->profile_photo);
        }
        $profilePhotoPath = $request->file('profile_photo')->store('institute_photos', 'public');
        $institute->profile_photo = $profilePhotoPath;
    }

    // Update cover photo
    if ($request->hasFile('cover_photo')) {
        if ($institute->cover_photo) {
            Storage::delete('public/' . $institute->cover_photo);
        }
        $institute->cover_photo = $request->file('cover_photo')->store('institute_covers', 'public');
    }

    // Save changes to institutes table
    $institute->update($request->only(['institute_name', 'location', 'email', 'contact_number', 'website', 'bio']));

    // Update corresponding user record
    $user = User::find($institute->user_id); // Assuming 'user_id' links the institute to the user
    if ($user) {
        $user->name = $request->input('institute_name');
        $user->email = $request->input('email');
        if ($request->hasFile('profile_photo')) {
            $user->profile_picture = $profilePhotoPath; // Update profile picture in users table
        }
        $user->save();
    }

    return redirect()->back()->with('success', 'Profile updated successfully.');
}


public function showCourses($id)
{
    $institute = Institute::with('posts')->findOrFail($id);
    return view('frontend.profile.profile-courses', compact('institute'));
}

}
