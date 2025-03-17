<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    // Display the category management page
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    //show in frontend
    public function showCategories()
{
    $categories = \App\Models\Category::all()->groupBy('main_category');
    return view('frontend.courses.courses', compact('categories'));
}




    // Store a new category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'main_category' => 'required|string',
            'name' => 'required|string',
            'icon' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    // Delete a category
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    
   

    // Update Category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'main_category' => 'required|string',
            'name' => 'required|string',
            'icon' => 'required|string',
        ]);

        // Update the category in the database
        $category->update([
            'main_category' => $request->main_category,
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
    }



// Edit Category
    public function edit($id)
{
    $category = Category::find($id);
    if (!$category) {
        // Return to the previous page or a specific view with a message
        return redirect()->route('categories.index')->with('error', 'Category not found.');
    }

    return view('categories.edit', compact('category'));
}


public function getCategories()
{
    return response()->json(Category::all());
}


}
