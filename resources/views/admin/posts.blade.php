<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
  <!-- Custom styles -->
  
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/usersview.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/admindash.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
                    function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    dropdown.classList.toggle('show');
}

// Close the dropdown if clicked outside
window.addEventListener('click', function (event) {
    const dropdown = document.getElementById('dropdown-menu');
    const profileButton = document.querySelector('.profile-btn');

    if (!dropdown.contains(event.target) && !profileButton.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});
    </script>
</head>

<body>
<div class="page-flex">
@include('admin.sidebar')
<div class="main-wrapper">
@include('admin.mainnavbar')


<div class="user-table">
    <div class="user-table-header">
        <h2 class="title">Posts</h2>       
    </div>
    <table class="table">
        <thead>
            <th>Title</th>
            {{-- <th>Image</th> --}}
            <th>Small Description</th>
            <th>Description</th>
            <th>Course Name</th>
            <th>Course Type</th>
            <th>Location</th>
            <th>Duration</th>
            <th>Course Format</th>
            <th>Attendance Type</th>
            <th>Likes Count</th>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
            <td data-label="Title">{{ $post->title }}</td>
            {{-- <td data-label="Image">
            @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Profile" class="photo-preview">
                    @else
                        N/A
                    @endif
            </td> --}}
            <td data-label="Small Description">{!! nl2br(e($post->small_description)) !!}</td>
            <td data-label="Description">{!! nl2br(e($post->description)) !!}</td>
            <td data-label="Course Name">{{ $post->course_name }}</td>
            <td data-label="Course Type">{{ $post->course_type }}</td>
            <td data-label="Location">{{ $post->location }}</td>
            <td data-label="Duration">{{ $post->duration }}</td>
            <td data-label="Course Format">{{ $post->course_format }}</td>
            <td data-label="Attendance Type">{{ $post->attendance_type }}</td>
            <td data-label="Likes Count">{{ $post->likes_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>