<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <!-- Add CSS and FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
    <link rel="stylesheet" href="{{ asset('css/discipline.css') }}">
    
    
    <style>
        
    </style>
</head>
<body>
    {{-- Include the Navbar --}}
    @include('frontend.navbar')

    <main>
        {{-- Content --}}
        <div class="courses-container">
            @include('frontend.courses.discipline')
        </div>
    </main>
    <script src="{{ asset('js/navbar.js') }}"></script>
</body>
</html>