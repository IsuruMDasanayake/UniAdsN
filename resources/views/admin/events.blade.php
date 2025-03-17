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
  <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
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
        <h2 class="title">Events</h2>
        
    </div>
    <table class="table">
        <thead>
           
              <th>Event Title</th>
              <th>Event Image</th>
              <th>Event Description</th>
              
              <th>Event Date</th>             
              <th>Location</th>
              
        </thead>
        <tbody>
            @foreach ($events as $event)
                <td data-label="event_title">{{ $event->event_title }}</td>
                <td data-label="Image">
                    @if($event->event_image)
                                <img src="{{ asset('storage/' . $event->event_image) }}" alt="Profile" class="photo-preview">
                            @else
                                N/A
                            @endif
                    </td>
                <td data-label="event_description">{{ $event->event_description }}</td>
                

                <td data-label="event_date">{{ $event->event_date }}</td>
              
                <td data-label="sub_location">{{ $event->sub_location }}</td>
                
                </tr>
            @endforeach
        </tbody>
    </table>
</div>





</body>
</html>