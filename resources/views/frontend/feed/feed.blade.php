<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Feed</title>
    <!-- Add CSS and FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
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
        {{-- Left Side Column with Toggle Arrow --}}
<div class="left-side-wrapper">
    <div class="toggle-arrow" onclick="toggleLeftSidebar()">&#x2192;</div>

    <div class="left-side-card" id="leftSidebar">
        @include('frontend.feed.programs')
    </div>
</div>


        {{-- Content Area --}}
<div class="middle-section">
    @include('frontend.feed.posts', ['posts' => $posts])
</div>

        {{-- Right Side Toggle Container --}}
<div class="right-toggle-container">
    <!-- Right Arrow Toggle Button -->
<div class="right-toggle-arrow" onclick="toggleRightSidebar()">
    <i class="fa fa-angle-left"></i>
</div>

    <div class="left-column" id="rightSideSection">
        @include('frontend.feed.events', ['events' => $events])
    </div>
</div>

    </main>

    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/programs.js') }}"></script>
    <script>
function toggleLeftSidebar() {
    const sidebar = document.getElementById('leftSidebar');
    sidebar.classList.toggle('show');
}


function toggleRightSidebar() {
    const sidebar = document.querySelector('.upcoming-events-card');
    const arrow = document.querySelector('.right-toggle-arrow');
    
    sidebar.classList.toggle('active');
    arrow.classList.toggle('active');
}


</script>

</body>
</html>
