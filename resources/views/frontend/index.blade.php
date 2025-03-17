<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to UniAds</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">UniAds</div>
        <nav>
            <a href="#features">Features</a>
            <a href="#about">About Us</a>
            <a href="#contact">Contact</a>

            <!-- Profile Dropdown -->
            <div class="profile-dropdown">
    <!-- Profile name button to toggle dropdown -->
    <button onclick="toggleDropdown()" class="profile-btn">
        <span class="username">{{ Auth::user()->name }}</span>
    </button>

    <!-- Dropdown Content -->
    <div id="dropdown-menu" class="dropdown-content">
        <a href="{{ route('profile.edit') }}">Account Settings</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="dropdown-link">Log Out</button>
        </form>
    </div>
</div>

        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-slideshow">
            <img src="{{ asset('images/image1.jpg') }}" alt="Image 1" class="hero-slide active">
            <img src="{{ asset('images/image2.jpg') }}" alt="Image 2" class="hero-slide">
            <img src="{{ asset('images/image3.jpg') }}" alt="Image 3" class="hero-slide">
            <img src="{{ asset('images/image4.jpg') }}" alt="Image 4" class="hero-slide">
            <img src="{{ asset('images/image5.jpg') }}" alt="Image 5" class="hero-slide">
            <img src="{{ asset('images/image6.jpg') }}" alt="Image 6" class="hero-slide">
            <img src="{{ asset('images/image7.jpg') }}" alt="Image 7" class="hero-slide">
            <img src="{{ asset('images/image8.jpg') }}" alt="Image 8" class="hero-slide">
            <img src="{{ asset('images/image9.jpg') }}" alt="Image 9" class="hero-slide">
        </div>
        <div class="hero-content-container">
            <div class="square-box">
            <div class="hero-content">
                <h1>Empowering Education with UniAds</h1>
                <p>Your gateway to higher education in Sri Lanka. Explore, connect, and unlock your future.</p>
                <a href="{{ url('/feed') }}" class="cta-btn">Discover More</a>
            </div>
    
            <!-- Square Box Behind Content -->
            
                
            </div>
        </div>
    </section>
    
    
   
</section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2>What We Offer</h2>
        <div class="features-grid">
            <div class="feature-card">
                <img src="{{ asset('images/welcome/Institutions.png') }}" alt="Institutions">
                <h3>Institution Profiles</h3>
                <p>Discover top universities and institutions in Sri Lanka with detailed profiles.</p>
            </div>
            <div class="feature-card">
                <img src="{{ asset('images/welcome/Program.png') }}" alt="Programs">
                <h3>Program Listings</h3>
                <p>Find programs tailored to your goals, including degrees, diplomas, and more.</p>
            </div>
            <div class="feature-card">
                <img src="{{ asset('images/welcome/Search.png') }}" alt="Search">
                <h3>Search & Filter</h3>
                <p>Easily search and filter programs by location, duration, or study mode.</p>
            </div>
            <div class="feature-card">
                <img src="{{ asset('images/welcome/Chat.png') }}" alt="Connect">
                <h3>Connect & Chat</h3>
                <p>Engage with institutions for guidance, queries, and feedback.</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <h2>About UniAds</h2>
        <p>
            UniAds is your one-stop solution for exploring higher education opportunities in Sri Lanka. 
            With detailed profiles, search tools, and interactive features, we empower students to find their ideal programs effortlessly.
        </p>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 UniAds. All Rights Reserved. <a href="#contact">Contact Us</a></p>
    </footer>

    <script>
        // Navbar Scroll Effect
const navbar = document.querySelector('.navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('hidden');
    } else {
        navbar.classList.remove('hidden');
    }
});
function toggleDropdown() {
    const dropdown = document.querySelector('.dropdown-content');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
// Close the dropdown if clicked outside
window.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown-menu');
    const profileButton = document.querySelector('.profile-btn');
    // If the click is outside the profile button and dropdown, close the dropdown
    if (!dropdown.contains(event.target) && !profileButton.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".hero-slide");
    let currentIndex = 0;

    // Function to switch the active image
    function changeSlide() {
        slides[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add("active");
    }

    // Change the slide every 3 seconds
    setInterval(changeSlide, 3000); // Change image every 3 seconds
});


    </script>
</body>
</html>
