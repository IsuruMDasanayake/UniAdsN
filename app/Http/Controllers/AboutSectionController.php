<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institute;
use App\Models\AboutSection;

class AboutSectionController extends Controller
{
    public function showAboutPage($id)
{
    // Fetch the institute details
    $institute = Institute::findOrFail($id);

    // Fetch the about section details for the given institute ID (nullable)
    $aboutSection = AboutSection::where('institute_id', $id)->first();
    $aboutSection = AboutSection::where('institute_id', $id)->first() ?? new AboutSection();

    // Pass both institute and about section data to the view
    return view('frontend.profile.profile-about', [
        'institute' => $institute,
        'aboutSection' => $aboutSection, // This could be null, and that's okay
    ]);
}


    


    public function store(Request $request, $id)
    {
        // Validation
        $validated = $request->validate([
            'institute_overview' => 'nullable|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'history' => 'nullable|string',
            'chancellor_intro' => 'nullable|string',
            'chancellor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'vice_chancellor_intro' => 'nullable|string',
            'vice_chancellor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'academic_excellence' => 'nullable|string',
            'academic_images' => 'nullable|array',
            'academic_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'programs_offered' => 'nullable|string',
            'programs_images' => 'nullable|array',
            'programs_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'global_partnerships' => 'nullable|string',
            'partnerships_images' => 'nullable|array',
            'partnerships_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'life_at_institute' => 'nullable|string',
            'life_images' => 'nullable|array',
            'life_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sports_recreation' => 'nullable|string',
            'sports_images' => 'nullable|array',
            'sports_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'upcoming_programs' => 'nullable|string',
            'upcoming_images' => 'nullable|array',
            'upcoming_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'campus_images' => 'nullable|array',
            'campus_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Prepare the data for storage
        $data = $validated;

        // Handle file uploads for single files
        if ($request->hasFile('chancellor_photo')) {
            $data['chancellor_photo'] = $request->file('chancellor_photo')->store('images', 'public');
        }

        if ($request->hasFile('vice_chancellor_photo')) {
            $data['vice_chancellor_photo'] = $request->file('vice_chancellor_photo')->store('images', 'public');
        }

        // Handle multiple file uploads
        $multiFileFields = ['academic_images', 'programs_images', 'partnerships_images', 'life_images', 'sports_images', 'upcoming_images', 'campus_images'];

        foreach ($multiFileFields as $field) {
            if ($request->hasFile($field)) {
                $uploadedFiles = [];
                foreach ($request->file($field) as $file) {
                    $uploadedFiles[] = $file->store('images', 'public');
                }
                $data[$field] = json_encode($uploadedFiles); // Store as JSON
            }
        }

        // Add the institute ID to the data
        $data['institute_id'] = $id;

        // Store data in the database
        AboutSection::create($data);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function update(Request $request, $id)
{
    // Validate the data
    $validated = $request->validate([
        'institute_overview' => 'nullable|string',
        'mission' => 'nullable|string',
        'vision' => 'nullable|string',
        'history' => 'nullable|string',
        'chancellor_intro' => 'nullable|string',
        'chancellor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'vice_chancellor_intro' => 'nullable|string',
        'vice_chancellor_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'academic_excellence' => 'nullable|string',
        'academic_images' => 'nullable|array',
        'academic_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'programs_offered' => 'nullable|string',
        'programs_images' => 'nullable|array',
        'programs_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'global_partnerships' => 'nullable|string',
        'partnerships_images' => 'nullable|array',
        'partnerships_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'life_at_institute' => 'nullable|string',
        'life_images' => 'nullable|array',
        'life_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'sports_recreation' => 'nullable|string',
        'sports_images' => 'nullable|array',
        'sports_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'upcoming_programs' => 'nullable|string',
        'upcoming_images' => 'nullable|array',
        'upcoming_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'campus_images' => 'nullable|array',
        'campus_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Prepare the data for update
    $data = $validated;

    // Handle file uploads for single files
    if ($request->hasFile('chancellor_photo')) {
        // Delete the old file if it exists
        if ($aboutSection->chancellor_photo && Storage::exists('public/' . $aboutSection->chancellor_photo)) {
            Storage::delete('public/' . $aboutSection->chancellor_photo);
        }
        $data['chancellor_photo'] = $request->file('chancellor_photo')->store('images', 'public');
    }

    if ($request->hasFile('vice_chancellor_photo')) {
        // Delete the old file if it exists
        if ($aboutSection->vice_chancellor_photo && Storage::exists('public/' . $aboutSection->vice_chancellor_photo)) {
            Storage::delete('public/' . $aboutSection->vice_chancellor_photo);
        }
        $data['vice_chancellor_photo'] = $request->file('vice_chancellor_photo')->store('images', 'public');
    }

    // Handle multiple file uploads
    $multiFileFields = ['academic_images', 'programs_images', 'partnerships_images', 'life_images', 'sports_images', 'upcoming_images', 'campus_images'];

    foreach ($multiFileFields as $field) {
        if ($request->hasFile($field)) {
            $uploadedFiles = [];
            foreach ($request->file($field) as $file) {
                $uploadedFiles[] = $file->store('images', 'public');
            }
            $data[$field] = json_encode($uploadedFiles); // Store as JSON
        }
    }

    // Update the data in the database
    $aboutSection = AboutSection::where('institute_id', $id)->first();
    $aboutSection->update($data);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Data updated successfully!');
}


public function destroy($id)
{
    // Find the about section by institute_id
    $aboutSection = AboutSection::where('institute_id', $id)->first();

    if ($aboutSection) {
        // If the record exists, delete it
        $aboutSection->delete();

        // Redirect with success message
        return redirect()->back()->with('success', 'Institute information deleted successfully.');
    }

    // If no record is found, redirect with an error message
    return redirect()->back()->with('error', 'No information found to delete for this institute.');
}


    
}
