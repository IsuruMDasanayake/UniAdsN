<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutSectionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__.'/auth.php';
Route::get('/', function () { return view('welcome'); });

Route::get('/feed', function () { return view('frontend.feed.feed'); });


Route::get('/home', function () { return view('frontend.home');})->middleware(['auth', 'verified'])->name('home');

//Admin dashboard
Route::get('/admin/admindash', [BackendController::class, 'admindash'])->name('admin.dashboard');

Route::get('/institutions', [InstituteController::class, 'showInstitutions'])->name('institutions.index');

Route::get('/courses', function () { return view('frontend.courses.courses'); });

Route::get('/courselist', function () { return view('frontend.courses.courselist'); });


//users show in backend
Route::get('/admin/users', [BackendController::class, 'index'])->name('admin.users');


// Define the route for updating a user's details
Route::post('/admin/users', [BackendController::class, 'update'])->name('admin.users');
Route::delete('/users/{id}', [BackendController::class, 'destroy'])->name('users.destroy');
Route::post('/users', [BackendController::class, 'store'])->name('users.store');

//Institutes in backend
Route::get('/admin/institutesmanage', [InstituteController::class, 'institutesmanage'])->name('admin.institutesmanage');
Route::patch('/admin/institutesmanage/{id}/approve', [InstituteController::class, 'approve'])->name('institute.approve');
Route::delete('/admin/institutesmanage/{id}', [InstituteController::class, 'destroy'])->name('institutes.destroy');
Route::patch('/admin/institutesmanage/{id}', [InstituteController::class, 'update'])->name('institute.update');
Route::delete('/admin/institutes/{id}', [InstituteController::class, 'destroy'])->name('institutes.destroy');

//Route::post('/admin/institutes/add', [InstituteController::class, 'addinstitute'])->name('institute.addinstitute');



//Institutes in frontend
Route::get('/institutionprofileadd', [InstituteController::class, 'instituteadd'])->name('frontend.institutions.institutionprofileadd');
Route::post('/store', [InstituteController::class, 'store'])->name('institute.store');



// Profile management for both users and institutes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//PostShow
//Route::get('/posts', [PostController::class, 'index'])->name('frontend.feed.feed');

//Institution profile shows to normal user
Route::get('/institutions/{id}/profile', [InstituteController::class, 'showProfile'])->name('frontend.profile.institute-edit');

Route::put('/institutions/{id}', [InstituteController::class, 'instituteupdate'])->name('updateInstitute');


//Categories in admin panel

Route::get('/admin/categories', [CategoryController::class, 'categories'])->name('admin.categories');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::patch('/admin/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

//shoe categories in frontend
Route::get('/courses', [CategoryController::class, 'showCategories'])->name('frontend.courses.courses');

//Add post form showing



// Routes for posts
// Route::post('/profile/{id}', [PostController::class, 'store'])->name('posts.store');
// Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
// Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
// Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
// Route::post('/posts/{postId}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');
Route::get('/posts/filter/{filterType}/{filterValue}', [PostController::class, 'filter'])->name('posts.filter');



// Post CRUD
Route::post('/profile/{id}', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

// Post Like Toggle
Route::post('/posts/{postId}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');

// Fetch Posts for Filtering
Route::get('/posts/feedfilter/{filterType}', [PostController::class, 'feedfilter'])->name('posts.feedfilter');




// Routes for events
Route::post('/profile/{id}/add-event', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');


Route::get('/feed', [PostController::class, 'showFeed'])->name('frontend.feed.feed');
Route::get('/feed', [EventController::class, 'showEvent'])->name('feed');



//routes for admindashpost
Route::get('/admin/posts', [PostController::class, 'adminPost'])->name('admin.posts');
//routes for admindashevents
Route::get('/admin/event', [EventController::class, 'adminEvents'])->name('admin.events');


//Institute Gallery
Route::post('/institute/gallery/store/{id}', [GalleryController::class, 'store'])->name('gallery.store');
Route::delete('/institute/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

//notification

// Fetch notifications for the logged-in user
Route::get('/notifications', [NotificationController::class, 'getNotifications'])->middleware('auth');

// Mark notifications as seen
Route::post('/notifications/seen', [NotificationController::class, 'markAsSeen'])->middleware('auth');


//Chats

Route::get('/get-messages/{chatId}', [ChatController::class, 'getMessages']);
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('sendMessage');





//Contact
Route::get('/institute/{id}/contact', [ContactController::class, 'showContactPage'])->name('institute.contact');
Route::post('/institute/{id}/contact', [ContactController::class, 'sendContactMessage'])->name('institute.contact.send');


//About
Route::get('/institute/{id}/about', [AboutSectionController::class, 'showAboutPage'])->name('institute.about');
Route::post('/institute/{id}/about', [AboutSectionController::class, 'store'])->name('about.submit');
Route::put('/institute/{id}/update', [AboutSectionController::class, 'update'])->name('institute.update');
Route::delete('/institute/{id}/about', [AboutSectionController::class, 'destroy'])->name('institute.destroy');

//courses 
//routes for causes view in institute profile
Route::get('/institute/{id}/courses', [InstituteController::class, 'showCourses'])->name('frontend.profile.profile-courses');


Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.sendResetCode');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.resetForm');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');
Route::get('confirm-password', [ForgotPasswordController::class, 'showConfirmForm'])->name('confirm.passwordForm');
