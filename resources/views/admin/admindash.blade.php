<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <!-- Favicon -->
  
  <!-- Custom styles -->
  
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/admindash.css') }}">
  
  <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
  
</head>

<body>
  
<!-- ! Body -->

<div class="page-flex">
    @include('admin.sidebar')


  <div class="main-wrapper">
    <!-- ! Main nav -->
    @include('admin.mainnavbar')
    
          <!-- Dashboard Stats Section -->
          <div class="dashboard-container">
            <!-- Stats Section -->
            <div class="stats-row">
              <div class="stats-card card-users">
                <div class="card-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                  <h3>Registered Users</h3>
                  <p>{{ $userCount }}</p>
                </div>
              </div>
              <div class="stats-card card-institutes">
                <div class="card-icon">
                  <i class="fas fa-building"></i>
                </div>
                <div class="card-content">
                  <h3>Registered Institutes</h3>
                  <p>{{ $instituteCount }}</p>
                </div>
              </div>
              <div class="stats-card card-popular">
                <div class="card-icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-content">
                  <h3>Posts Count</h3>
                  <p>{{ $postCount }}</p>
                </div>
              </div>
              <div class="stats-card card-views">
                <div class="card-icon">
                  <i class="fas fa-eye"></i>
                </div>
                <div class="card-content">
                  <h3>Event Count</h3>
                  <p>{{ $eventCount }}</p>
                </div>
              </div>
            </div>
    
            <!-- Charts Section -->
            <div class="charts-row">
              <div class="chart-card">
                <h3>Site Engagement</h3>
                <canvas id="engagementChart"></canvas>
              </div>
              <div class="chart-card">
                <h3>Post Activity</h3>
                <canvas id="activityChart"></canvas>
              </div>
            </div>
          </div>
    
          <!-- Chart.js -->
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
            const engagementChart = new Chart(document.getElementById('engagementChart'), {
              type: 'doughnut',
              data: {
                labels: ['Users', 'Institutes', 'Posts', 'event'],
                datasets: [{
                  data: [{{ $userCount }}, {{ $instituteCount }}, {{ $postCount }}, {{ $eventCount }}],
                  backgroundColor: ['#6a11cb', '#2575fc', '#f9a825', '#1ad720'],
                }]
              }
            });
    
            const activityChart = new Chart(document.getElementById('activityChart'), {
              type: 'bar',
              data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                datasets: [{
                  label: 'Posts Created',
                  data: [5, 8, 7, 10, 12, 6, 3],
                  backgroundColor: '#6a11cb'
                }]
              }
            });

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
        </div>
      </div>
   

</body>

</html>

