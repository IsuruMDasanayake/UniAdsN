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
    
    
    
    <style>
/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
}

.page-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 20px;
}

/* Course Card Styles */
.course-card {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    transition: box-shadow 0.3s ease;
}

.course-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Left Section: Course Details */
.course-details {
    width: 65%;
}

.course-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 5px;
    color: #222;
}

.course-meta {
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 15px;
}

.institute-details {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.institute-logo {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
}

.institute-name {
    font-weight: bold;
    font-size: 0.9rem;
}

.institute-location {
    font-size: 0.8rem;
    color: #777;
}

.programme-link {
    font-size: 0.9rem;
    color: #007BFF;
    text-decoration: none;
}

.programme-link:hover {
    text-decoration: underline;
}

/* Right Section: Course Features */
.course-features {
    width: 30%;
    text-align: right;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.course-price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

.course-duration {
    font-size: 0.9rem;
    color: #555;
}

.course-status {
    font-size: 0.8rem;
    color: #28a745;
    font-weight: bold;
    text-transform: uppercase;
}

.compare-option {
    font-size: 0.9rem;
    color: #555;
}

.compare-option input {
    margin-right: 5px;
}



    </style>
</head>
<body>
    {{-- Include the Navbar --}}
    @include('frontend.navbar')

    <main>
        <div class="container">
            <h1 class="page-title">Courses</h1>
            <div class="course-card">
                <div class="course-details">
                    <h2 class="course-title">International Business</h2>
                    <p class="course-meta">B.B.A. / Full-time / On Campus</p>
                    <div class="institute-details">
                        <img src="institute-logo.png" alt="Institute Logo" class="institute-logo">
                        <span class="institute-name">College of Business and Economics</span>
                        <span class="institute-location">Boise, Idaho, United States</span>
                    </div>
                    <a href="#" class="programme-link">View Programme Information</a>
                </div>
                <div class="course-features">
                    <span class="course-price">8,074,536 LKR / year</span>
                    <span class="course-duration">4 years</span>
                    <span class="course-status">Featured</span>
                    <div class="compare-option">
                        <input type="checkbox" id="compare" />
                        <label for="compare">Add to compare</label>
                    </div>
                </div>
            </div>
        </div>
    
        
    </main>
    <script></script>
</body>
</html>