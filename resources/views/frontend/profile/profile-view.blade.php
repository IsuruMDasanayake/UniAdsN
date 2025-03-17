<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/addpost.css') }}">
    <link rel="stylesheet" href="{{ asset('css/instituteedit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    

    <script src="{{ asset('js/navbar.js') }}"></script>
    
</head>
<body>

    @include('frontend.navbar')

    
    <div class="profile-container">
        <!-- Cover Photo -->
        <img src="{{ asset('storage/' . $institute->cover_photo) }}" alt="Cover" class="photo-preview">
    
        <!-- Profile Section -->
        <div class="profile-section">
            <!-- Profile Picture -->
            <div class="profile-picture">
                <img src="{{ $institute->profile_photo ? asset('storage/' . $institute->profile_photo) : asset('images/default-logo.png') }}" alt="Profile Picture">
            </div>
    
            <!-- Profile Details -->
            <div class="profile-details">
                <h1 id="universityName">{{ $institute->institute_name }}</h1>
                <p><strong id="bio"> {{ $institute->bio }}</strong>
                <p><strong>Location:</strong> {{ $institute->location }}</p>
                <p><strong>Email:</strong> {{ $institute->email }}</p>
                <p><strong>Website:</strong> <a href="{{ $institute->website }}" target="_blank">{{ $institute->website }}</a></p>
                {{-- <p><strong>Contact:</strong> {{ $institute->contact_number }}</p> --}}
            </div>
    

            <!-- Add Post Button -->
            <div class="button-container">
                @if(Auth::check() && Auth::user()->role === 'Institute' && Auth::user()->id === $institute->user_id)
                <button class="btn-add-post" onclick="openAddPostModal()">
                    <i class="material-icons">add_circle</i> Add Post 
                </button>&nbsp;
                @endif
                </div>

             <!-- Add Event Button -->       
            @if(Auth::check() && Auth::user()->role === 'Institute' && Auth::user()->id === $institute->user_id)
            <button class="btn-add-event" onclick="openAddEventModal()">
                <i class="material-icons">event</i> Add Event
            </button>&nbsp; 
@endif

            
            <!-- Edit Profile Button -->         
            @if(Auth::check() && Auth::user()->role === 'Institute' && Auth::user()->id === $institute->user_id)
            <button class="btn-edit-profile" onclick="openModal()">
                <i class="material-icons">edit</i> Edit Profile
            </button>@endif
        </div>
    
        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <div class="button-container">
            <a href="{{ route('frontend.profile.institute-edit', ['id' => $institute->id]) }}">FEED</a>
            <a href="{{ route('institute.about', $institute->id) }}">ABOUT</a>
            <a href="{{ route('frontend.profile.profile-courses', ['id' => $institute->id]) }}">COURSES</a>
            <a href="{{ route('institute.contact', $institute->id) }}">CONTACT</a>
            
            
                
            </div>
        </div>

    </body>
    </html>     