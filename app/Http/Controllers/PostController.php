<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Institute;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
class PostController extends Controller
{
    
public function store(Request $request, $id)
{
    // Validate the incoming data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'small_description' => 'required|string',
        'course_name' => 'required|string',
        'course_type' => 'required|string',
        'location' => 'required|string',
        'duration' => 'required|string',
        'course_format' => 'required|string',
        'attendance_type' => 'required|string',
        'image' => 'required|image|max:1024',
    ]);

    // Get the logged-in user's institute ID
    $instituteId = Auth::user()->institute->id;

    // Handle image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('post_images', 'public');
    }

    // Create a new post and associate it with the institute
    Post::create([
        'title' => $request->title,
        'description' => $request->description,
        'small_description' => $request->small_description,
        'course_name' => $request->course_name,
        'course_type' => $request->course_type,
        'location' => $request->location,
        'duration' => $request->duration,
        'course_format' => $request->course_format,
        'attendance_type' => $request->attendance_type,
        'image' => $imagePath ?? null,
        'institute_id' => $instituteId, // Link the post to the logged-in institute
    ]);

    
       // Get the logged-in user's institute and ID
    $userInstituteId = Auth::user()->institute_id;
    $userId = Auth::id();

    

    // Create a single notification for the post (exclude the creator from receiving the notification)
    Notification::create([
        'title' => 'New Post Added',
        'message' => 'An institute has added a new post about their program.',
        'type' => 'post', // or 'event' for events
        'created_by' => $userId, // The ID of the user who uploaded the post
        'institute_id' => $instituteId, // Institute that added the post
    ]);
    

    

    return redirect()->back()->with('success', 'Post created successfully!');
}

    

public function showProfile($id)
{
    $institute = Institute::findOrFail($id);
    return view('frontend.profile.institute-edit', compact('institute'));
}

public function showFeed()
{
    $posts = Post::with('institute')->latest()->paginate(3); // Loads first 6 posts
    return view('frontend.feed.feed', compact('posts'));
}

public function loadMore(Request $request)
{
    $page = $request->input('page', 1);

    $posts = Post::with('institute')
        ->orderBy('created_at', 'desc')
        ->paginate(3, ['*'], 'page', $page);

    return response()->json([
        'html' => view('frontend.feed.post_partial', compact('posts'))->render(),
        'next_page' => $posts->currentPage() + 1,
        'has_more' => $posts->hasMorePages(),
    ]);
}



public function showPostsProfile()
{
    $posts = Post::with('institute')->latest()->get();
    foreach ($posts as $post) {
        \Log::info($post->institute); // Log institute data for debugging
    }

    return view('frontend.profile.institute-edit', compact('posts'));
}



public function edit($id)
{
    $post = Post::findOrFail($id);

    // Return the post data as JSON
    return response()->json($post);
}




public function update(Request $request, $id)
{
    $post = Post::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'small_description' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:1024',
        'course_name' => 'required|string',
        'course_type' => 'required|string',
        'location' => 'required|string',
        'duration' => 'required|string',
        'course_format' => 'required|string',
        'attendance_type' => 'required|string',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('post_images', 'public');
        $post->image = $imagePath;
    }

    $post->update($request->only([
        'title',
        'small_description',
        'description',
        'course_name',
        'course_type',
        'location',
        'duration',
        'course_format',
        'attendance_type',
    ]));

    return redirect()->back()->with('success', 'Post updated successfully.');
}


public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Delete the associated image file if it exists
    if (Auth::check() && Auth::user()->id === $post->user_id) {
        $post->delete();
        return response()->json(['success' => true]);
    }
    $post->delete();

    return response()->json(['success' => false, 'message' => 'Not authorized or post not found'], 400);
}



//admin post
public function adminPost()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }


    //like function
    public function toggleLike($postId)
{
    $post = Post::findOrFail($postId);
    $userId = auth()->id(); // Get the logged-in user's ID

    // Check if the user has already liked the post
    $likedPost = $post->likes()->where('user_id', $userId)->first();

    if ($likedPost) {
        // If the user has liked the post, remove the like (decrease the like count)
        $likedPost->delete();
        $post->decrement('likes_count');
        $liked = false;
    } else {
        // If the user hasn't liked yet, add the like (increase the like count)
        $post->likes()->create(['user_id' => $userId]);
        $post->increment('likes_count');
        $liked = true;
    }

    // Return the updated like count and liked status
    return response()->json([
        'likes_count' => $post->likes_count,
        'liked' => $liked
    ]);
}

public function filter($filterType, $filterValue)
{
    $query = Post::query();

    // Map filterType to the corresponding column in the database
    $filterMap = [
        'Courses' => 'course_name',
        'Course Type' => 'course_type',
        'Location' => 'location',
        'Duration' => 'duration',
        'Course Format' => 'course_format',
        'Attendance Type' => 'attendance_type',
    ];

    if (array_key_exists($filterType, $filterMap)) {
        $query->where($filterMap[$filterType], $filterValue);
    }

    // Sort by newest first
    $posts = $query->with('institute')
                   ->orderBy('created_at', 'desc')
                   ->get();

    return view('frontend.courses.categories', compact('posts', 'filterType', 'filterValue'));
}





 // Recent Posts (Latest First)
 public function getRecentPosts()
 {
     $posts = Post::with('institute')->latest()->get();
     return response()->json($posts);
 }

 // Popular Posts (Most Liked First)
 public function getPopularPosts()
 {
     $posts = Post::with('institute')->orderBy('likes_count', 'desc')->get();
     return response()->json($posts);
 }

 // Most Viewed Posts (Most Viewed First)
 public function getMostViewedPosts()
 {
     $posts = Post::with('institute')->orderBy('views_count', 'desc')->get();
     return response()->json($posts);
 }

 // General Filter Function
 public function feedfilter($filterType)
 {
     switch ($filterType) {
         case 'recent':
             return $this->getRecentPosts();
         case 'popular':
             return $this->getPopularPosts();
         case 'most-viewed':
             return $this->getMostViewedPosts();
         default:
             return response()->json(['error' => 'Invalid filter type'], 400);
     }
 }





public function loadMorePosts(Request $request, $id)
{
    $page = $request->input('page', 1);
    $institute = Institute::findOrFail($id);
    $posts = $institute->posts()->latest()->paginate(3, ['*'], 'page', $page);

    if ($request->ajax()) {
        return view('frontend.profile.partials.institute-posts', compact('posts'))->render();
    }

    return abort(404);
}



}