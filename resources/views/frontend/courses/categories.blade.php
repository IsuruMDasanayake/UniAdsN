<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <!-- FontAwesome & CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <script src="{{ asset('js/navbar.js') }}"></script>
    <style>
        /* General Styles */
        body {
    font-family: 'Poppins', sans-serif;
    margin-top: -40px;
    padding: 0;
    color: #333;
    background-color: #d1deec; /* Light background for contrast */
}

.container {
    max-width: 850px;
    margin: 20px auto;
    padding: 20px;
}

.page-title {
    font-size: 1.5rem;
    
    text-align: center;
    margin-bottom: 20px;
}

.post-card {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    padding: 20px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}



.post-image-wrapper {
    flex: 0 0 30%; /* Image occupies 30% of the container */
    height: 100%;
    overflow: hidden;
    border-radius: 8px;
}

.post-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.post-details {
    flex: 1; /* Details occupy the remaining space */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.institute-details {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.profile-picture {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #ddd;
    object-fit: cover;
}

.institute-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2a4d6c;
}

.post-timestamp {
    font-size: 12px; /* Smaller font size for the timestamp */
    color: #777; /* Light gray color for the timestamp */
    font-weight: 400; /* Normal font weight */
    margin-top: 5px; /* Adds space between the institute name and timestamp */
    text-align: center; /* Centers the timestamp below the name */
    letter-spacing: 0.5px; /* Adds slight spacing for readability */
    opacity: 0.8; /* Slight opacity for a subtle effect */
    font-family: 'Roboto', sans-serif; /* Clean and modern font */
}

.post-title {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
    margin-top: 5px;
}
.post-description {
    font-size: 14px;
    font-weight: 300; /* Makes the text thinner */
    color: #555; /* Softer color for readability */
    line-height: 1.6; /* Increases line spacing for a cleaner look */
    margin: 10px 0; /* Adds spacing above and below the text */
   
    text-align: justify; /* Aligns text for a neat appearance */
    padding: 0 10px; /* Adds slight padding for better spacing inside the container */
    overflow: hidden; /* Ensures no overflow issues */
    text-overflow: ellipsis; /* Adds ellipsis for long text */
    display: -webkit-box; /* For limiting lines */
    -webkit-line-clamp: 3; /* Limits text to 3 lines */
    -webkit-box-orient: vertical;
    transition: color 0.3s ease; /* Smooth color transition on hover */
}


.post-meta {
    font-size: 0.9rem;
    color: #555;
    margin-top: 15px;
}

.programme-link {
    font-size: 1rem;
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.2s ease;
    margin-left: 250px;
}

.programme-link:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .post-card {
        flex-direction: column;
        padding: 15px;
    }

    .post-image-wrapper {
        flex: none;
        width: 100%;
        height: 200px;
    }

    .post-title {
        font-size: 1.3rem;
    }

    .programme-link {
        font-size: 0.9rem;
    }
}

       /* General Modal Styles */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed;
    top: 58.5%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    border-radius: 8px;
    max-width: 100%;
    width: 900px;
    z-index: 1000;
    overflow: hidden;
    height: 80vh;
    
}

/* Modal Content */
.modal-content {
    display: flex;
    flex-direction: row;
    width: 100%;
    height: 100%;
}

/* Left Section (Image) */
.modal-left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
    overflow: hidden;
}

.modal-image {
    width: 100%;
    height: auto;
    border-radius: 8px 0 0 8px;
    object-fit: cover;
}

/* Right Section (Description) */
.modal-right {
    flex: 2;
    display: flex;
    flex-direction: column;
    padding: 20px;
    overflow: hidden;
}

/* Header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
    margin-bottom: 10px;
}

.modal-title {
    font-size: 1.5rem;
    color: #333;
}

.modal-close {
    font-size: 1.2rem;
    cursor: pointer;
    color: #666;
}

/* Description Scroll */
.modal-description-container {
    flex: 1;
    overflow-y: auto;
    padding-right: 10px; /* Add padding for smooth scrolling */
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: #ccc #f5f5f5;
}

.modal-description-container::-webkit-scrollbar {
    width: 8px;
}

.modal-description-container::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
}

.modal-description-container::-webkit-scrollbar-track {
    background-color: #f5f5f5;
}

.modal-description {
    font-size: 1rem;
    line-height: 1.6;
    color: #555;
    word-wrap: break-word;
}






    </style>
</head>
<body>
    {{-- Include Navbar --}}
    @include('frontend.navbar')

    <div class="container">
        <h1 class="page-title">Posts for {{ $filterType }}: {{ $filterValue }}</h1>
        @forelse ($posts as $post)
            <div class="post-card">
                <div class="post-image-wrapper">
                    <img class="post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
                </div>
                <div class="post-details">
                    <div class="institute-details">
                        <img class="profile-picture" src="{{ asset('storage/' . ($post->institute->profile_photo ?? 'images/default-logo.png')) }}" alt="Institute Logo">
                        <span class="institute-name">{{ $post->institute->institute_name }}</span>
                        <p class="post-timestamp">{{ $post->created_at->format('F j, Y') }}</p>
                    </div>
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <h3 class="post-description">{{ $post->small_description }}</h3>
                    <p class="post-meta">{{ $post->attendance_type }} / {{ $post->duration }} / {{ $post->course_type }}</p>
                    <a href="javascript:void(0)" 
   class="programme-link" 
   data-title="{{ $post->title }}" 
   data-description="{{ nl2br(e($post->description)) }}" 
   data-image="{{ asset('storage/' . $post->image) }}" 
   onclick="openModalFromLink(this)">
   View Programme Information
</a>

                    
                </div>
            </div>
        @empty
            <p>No posts found for {{ $filterType }}: {{ $filterValue }}</p>
        @endforelse
    </div>
    

    <!-- Modal Structure -->
<div class="modal-overlay" id="modal-overlay"></div>
<div class="modal" id="modal">
    <div class="modal-content">
        <div class="modal-left">
            <img id="modal-image" class="modal-image" alt="Post Image">
        </div>
        <div class="modal-right">
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title"></h2>
                <span class="modal-close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-description-container">
                <p id="modal-description" class="modal-description"></p>
            </div>
        </div>
    </div>
</div>
    

<!-- Modal Overlay -->
<div id="modal-overlay" class="modal-overlay" onclick="closeModal()"></div>


<!-- Modal Overlay -->
<div id="modal-overlay" class="modal-overlay" onclick="closeModal()"></div>


    <script>
        function openModalFromLink(linkElement) {
    // Get data attributes from the clicked link
    const title = linkElement.getAttribute('data-title');
    const description = linkElement.getAttribute('data-description');
    const imageSrc = linkElement.getAttribute('data-image');

    // Update modal content
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-description').innerHTML = description; // Use innerHTML for HTML content
    document.getElementById('modal-image').src = imageSrc;

    // Show modal
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('modal-overlay').style.display = 'block';
}


// Ensure modal is closed on page load
window.onload = function () {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('modal-overlay').style.display = 'none';
};

// Close the modal
function closeModal() {
    const modal = document.getElementById('modal');
    const modalOverlay = document.getElementById('modal-overlay');

    modal.style.display = 'none';
    modalOverlay.style.display = 'none';
}

// Close modal when clicking outside it
window.addEventListener('click', function (event) {
    const modal = document.getElementById('modal');
    const modalOverlay = document.getElementById('modal-overlay');

    if (event.target === modalOverlay) {
        closeModal();
    }
});


    </script>
</body>
</html>