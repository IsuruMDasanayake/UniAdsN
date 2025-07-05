<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - {{ $institute->institute_name }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/profilecourses.css') }}">
</head>
<body>
    @include('frontend.profile.profile-view')

    <div class="container">
        <h3>Courses Offered by {{ $institute->institute_name }}</h3><br>

        <div class="courses-grid">
            @foreach($institute->posts as $post)
                <div class="course-card" 
     onclick="openModal(
        '{{ asset('storage/' . $post->image) }}',
        '{{ addslashes($post->title) }}',
        `{!! addslashes(strip_tags($post->description)) !!}`,
        '{{ $post->institute->id }}',
        '{{ $post->institute->contact_number }}'
    )">

                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="course-image">
                    <h3 class="course-title">{{ $post->title }}</h3>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Main Post Modal -->
<div id="postModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <div class="modal-body">
      <img id="modalImage" src="" alt="Post Image" class="modal-image">
      <div class="modal-text">
        <h3 id="modalTitle" class="modal-title"></h3>
        <p id="modalDescription" class="modal-description"></p>

        <!-- Buttons -->
        <div class="modal-footer">
          <button class="btn-primary" onclick="openApplyNow()">Apply Now</button>
          <button class="btn-secondary" onclick="openMoreInfo()">Get More Information</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Apply Now Modal -->
<div id="applyModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeApplyModal()">&times;</span>
    <h3 class="modal-title">Apply for Course</h3>
    <form id="applyForm" method="POST">
      @csrf
      <input type="hidden" name="course_title" id="applyCourseTitle" />
      <div class="form-group">
        <label>Your Name</label>
        <input type="text" name="name" required />
      </div>
      <div class="form-group">
        <label>Your Email</label>
        <input type="email" name="email" required />
      </div>
      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" required />
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea name="message" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn-primary">Send Message</button>
    </form>
  </div>
</div>

<!-- Info Modal -->
<div id="infoModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeInfoModal()">&times;</span>
    <h3 class="modal-title">More Information</h3>
    <p id="infoMessage" class="modal-description"></p>
  </div>
</div>


    <script>
        
let currentCourseTitle = "";
let currentInstituteId = null;
let currentInstitutePhone = "";

function openModal(imageSrc, title, description, instituteId, phone) {
  const modal = document.getElementById('postModal');
  document.getElementById('modalImage').src = imageSrc;
  document.getElementById('modalTitle').innerText = title;
  document.getElementById('modalDescription').innerText = description;

  currentCourseTitle = title;
  currentInstituteId = instituteId;
  currentInstitutePhone = phone;

  modal.style.display = 'flex';
}

function closeModal() {
  document.getElementById('postModal').style.display = 'none';
}

function openApplyNow() {
  document.getElementById('postModal').style.display = 'none';
  document.getElementById('applyCourseTitle').value = currentCourseTitle;
  document.getElementById('applyForm').action = `/course/apply/${currentInstituteId}`;
  document.getElementById('applyModal').style.display = 'flex';
}

function closeApplyModal() {
  document.getElementById('applyModal').style.display = 'none';
}

function openMoreInfo() {
  document.getElementById('infoMessage').innerHTML = `For more information about this course, please call <strong>${currentInstitutePhone}</strong>.`;
  document.getElementById('infoModal').style.display = 'flex';
}

function closeInfoModal() {
  document.getElementById('infoModal').style.display = 'none';
}

// Close modal when clicking outside
window.addEventListener('click', function (e) {
  ['postModal', 'applyModal', 'infoModal'].forEach(id => {
    const modal = document.getElementById(id);
    if (e.target === modal) modal.style.display = 'none';
  });
});


    </script>

</body>
</html>