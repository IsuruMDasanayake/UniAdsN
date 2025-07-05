<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to UniAds</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="header-left">
        <div class="logo">UniAds</div>
        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="header-menu" id="headerMenu">
        <nav>
            <a href="#features">Features</a>
            <a href="#about">About Us</a>
            <a href="#footer">Contact</a>
        </nav>

        <!-- Profile Dropdown -->
        <div class="profile-dropdown">
            <button onclick="toggleDropdown()" class="profile-btn">
                <span class="username">{{ Auth::user()->name }}</span>
            </button>
            <div id="dropdown-menu" class="dropdown-content">
                <a href="{{ route('profile.edit') }}">Account Settings</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="dropdown-link">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-slideshow">
        <img src="{{ asset('images/image1.jpg') }}" class="hero-slide active" alt="Slide 1">
        <img src="{{ asset('images/image2.jpg') }}" class="hero-slide" alt="Slide 2">
        <img src="{{ asset('images/image3.jpg') }}" class="hero-slide" alt="Slide 3">
    </div>
    <div class="hero-content-container">
        <div class="square-box">
            <div class="hero-content">
                <h1>Empowering Education with UniAds</h1>
                <p>Your gateway to higher education in Sri Lanka. Explore, connect, and unlock your future.</p>
                <a href="{{ url('/feed') }}" class="cta-btn">Discover More</a>
            </div>
        </div>
    </div>
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
        <strong>UniAds</strong> is more than just a platform — it’s a trusted gateway to Sri Lanka’s higher education landscape. 
        We empower students, parents, and institutions by connecting them through verified information, personalized guidance, and real-time communication.
    </p>
    <p>
        With detailed university profiles, advanced course filters, and instant chat features, UniAds helps students make informed decisions and institutions reach the right audience.
        Whether you're searching for a degree, diploma, or master's program — <strong>UniAds puts the future of education in your hands.</strong>
    </p>
    <p>
        Join a growing network of learners and institutions. <strong>Your academic journey starts here, with UniAds.</strong>
    </p>
</section>


<!-- Footer -->
<footer class="footer">
    <p>
        &copy; 2025 UniAds. All Rights Reserved.  
        <a href="https://wa.me/94772300279" target="_blank" class="whatsapp-link">
            <i class="fab fa-whatsapp"></i>  Contact Us
        </a>
    </p>
</footer>


<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown-menu');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    function toggleMenu() {
        document.getElementById('headerMenu').classList.toggle('show');
    }

    // Close dropdown if clicked outside
    window.addEventListener('click', function(event) {
        const dropdown = document.getElementById('dropdown-menu');
        const profileBtn = document.querySelector('.profile-btn');
        if (!dropdown.contains(event.target) && !profileBtn.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });

    // Hero slideshow logic
    document.addEventListener("DOMContentLoaded", function () {
        const slides = document.querySelectorAll(".hero-slide");
        let currentIndex = 0;

        function changeSlide() {
            slides[currentIndex].classList.remove("active");
            currentIndex = (currentIndex + 1) % slides.length;
            slides[currentIndex].classList.add("active");
        }

        setInterval(changeSlide, 3000);
    });
</script>
</body>
</html>
