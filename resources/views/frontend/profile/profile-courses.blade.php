<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - {{ $institute->institute_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<style>
        /* Grid Styling */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .courses-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 fixed columns */
    gap: 20px;
}
        .course-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            text-align: right;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .course-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
        }
        .course-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            padding: 0 10px;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
        .modal-content {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 800px;
            width: 90%;
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        .modal-body {
            display: flex;
            gap: 20px;
        }
        .modal-image {
            width: 40%;
            height: auto;
            border-radius: 8px;
        }
        .modal-text {
            flex-grow: 1;
        }
        .modal-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .modal-description {
        font-size: 16px;
        color: #555;
        text-align: left; /* Align text to the left */
        width: 4in; /* Set the width to 4 inches */
        word-wrap: break-word; /* Ensure text wraps properly */
        margin: 0 auto; /* Center the description block */
    }
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            color: #333;
            cursor: pointer;
        }
    </style>
<body>
    @include('frontend.profile.profile-view')

    <div class="container">
        <h3>Courses Offered by {{ $institute->institute_name }}</h3><br>

        <div class="courses-grid">
            @foreach($institute->posts as $post)
            <div class="course-card">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="course-image" onclick="openModal('{{ asset('storage/' . $post->image) }}', '{{ $post->title }}', '{{ $post->description }}')">
                <h3 class="course-title">{{ $post->title }}</h3>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div id="postModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Post Image" class="modal-image">
                <div class="modal-text">
                    <h3 id="modalTitle" class="modal-title"></h3>
                    <p id="modalDescription" class="modal-description"></p>
                </div>
            </div>
        </div>
    </div>

    

    <script>
        function openModal(imageSrc, title, description) {
            document.getElementById('postModal').style.display = 'flex';
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerText = description;
        }

        function closeModal() {
            document.getElementById('postModal').style.display = 'none';
        }
    </script>
</body>
</html>