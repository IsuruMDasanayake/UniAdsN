<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Event;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SearchController extends Controller
{
    

public function search(Request $request)
{
    $query = trim($request->input('query'));

    if ($query === '') {
        return redirect()->back()->with('error', 'Please enter a search term.');
    }

    $posts = Post::where('title', 'LIKE', "%{$query}%")->latest()->get();

    return view('frontend.search.course-results', compact('query', 'posts'));
}



}
