<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Feed</title>
    <!-- Add CSS and FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <style>
        
    </style>
</head>
<body>
    

    {{-- Include the Navbar --}}
    @include('frontend.navbar')

    <main>
        {{-- Left Side Column --}}
        <div class="left-side-card">
            @include('frontend.feed.programs')
        </div>

        {{-- Content Area --}}
<div class="middle-section">
    @include('frontend.feed.posts', ['posts' => $posts])
</div>

        {{-- Right Side Column --}}
        <div class="left-column">
            @include('frontend.feed.events', ['events' => $events])
        </div>
    </main>

    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/programs.js') }}"></script>

</body>
</html>
