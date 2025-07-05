<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Search Results</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome and Custom CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/feed.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
    <script src="{{ asset('js/navbar.js') }}"></script>
</head>
<body>
@include('frontend.navbar')

<div class="container">
    <h1 class="page-title">Search Results for "{{ $query }}"</h1>

    @forelse ($posts as $post)
        <div class="post-card">
            <div class="post-image-wrapper">
                <img class="post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
            </div>
            <div class="post-details">
                <div class="institute-details">
                    <a href="{{ url('/institutions/' . $post->institute->id . '/profile') }}">
                        <img class="profile-picture" src="{{ asset('storage/' . ($post->institute->profile_photo ?? 'images/default-logo.png')) }}" alt="Institute Logo">
                    </a>
                    <a href="{{ url('/institutions/' . $post->institute->id . '/profile') }}" class="institute-name-link">
                        <span class="institute-name">{{ $post->institute->institute_name }}</span>
                    </a>
                    <p class="post-timestamp">{{ $post->created_at->format('F j, Y') }}</p>
                </div>

                <h2 class="post-title">{{ $post->title }}</h2>
                <h3 class="post-description">{{ $post->small_description }}</h3>
                <p class="post-meta">{{ $post->course_type }} / {{ $post->duration }} / {{ $post->attendance_type }}</p>

                <a href="javascript:void(0)" 
                   class="programme-link" 
                   data-title="{{ $post->title }}" 
                   data-description="{{ e($post->description) }}" 
                   data-image="{{ asset('storage/' . $post->image) }}" 
                   data-institute-id="{{ $post->institute->id }}"
                   data-contact="{{ $post->institute->contact_number }}"
                   onclick="openModalFromLink(this)">
                   <br>View Programme Information
                </a>
            </div>
        </div>
    @empty
        <p>No courses found with the title "{{ $query }}".</p>
    @endforelse
</div>



<!-- Programme Info Modal -->
<div id="programmeModal" class="programme-modal">
  <div class="programme-modal-content">
    <span class="programme-close-btn" onclick="closeProgrammeModal()">&times;</span>
    <img id="programmeImage" class="programme-image" src="" alt="Programme Image">
    <h3 id="programmeTitle" class="programme-title"></h3>
    <p id="programmeDescription" class="programme-description"></p>

    <!-- Modal Footer -->
    <div class="programme-footer">
      <button class="btn-primary" onclick="openApplyModal()">Apply Now</button>
      <button class="btn-secondary" onclick="openMoreInfoModal()">Get More Information</button>
    </div>
  </div>
</div>

<!-- Apply Now Modal -->
<div id="applyModal" class="programme-modal">
  <div class="programme-modal-content">
    <span class="programme-close-btn" onclick="closeApplyModal()">&times;</span>
    <h3 id="applyCourseTitle" class="programme-title">Apply for Course</h3>
    <form id="applyForm" method="POST" action="">
      @csrf
      <input type="hidden" name="course_title" id="hiddenCourseTitle">
      <input type="hidden" name="institute_id" id="hiddenInstituteId">

      <div class="form-group">
        <label for="applicant_name">Your Name</label>
        <input type="text" name="name" id="applicant_name" required>
      </div>
      <div class="form-group">
        <label for="applicant_email">Email</label>
        <input type="email" name="email" id="applicant_email" required>
      </div>
      <div class="form-group">
        <label for="applicant_phone">Phone Number</label>
        <input type="text" name="phone" id="applicant_phone" required>
      </div>
      <div class="form-group">
        <label for="applicant_message">Message</label>
        <textarea name="message" id="applicant_message" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn-primary">Send Message</button>
    </form>
  </div>
</div>

<!-- More Information Modal -->
<div id="infoModal" class="programme-modal" style="display:none; justify-content:center; align-items:center;">
  <div class="programme-modal-content">
    <span class="programme-close-btn" onclick="closeInfoModal()">&times;</span>
    <h3 class="programme-title">More Information</h3>
    <p id="infoMessage" style="font-size:16px; color:#333; margin-top: 15px;"></p>
  </div>
</div>

<script src="{{ asset('js/modal.js') }}"></script>


<script>
let currentInstitutePhone = null;

function openModalFromLink(link) {
    const title = link.dataset.title;
    const description = link.dataset.description;
    const image = link.dataset.image;
    const instituteId = link.dataset.instituteId;
    const contact = link.dataset.contact;

    currentInstitutePhone = contact;

    document.getElementById('programmeTitle').innerText = title;
    document.getElementById('programmeDescription').innerText = description;
    document.getElementById('programmeImage').src = image;

    document.getElementById('hiddenCourseTitle').value = title;
    document.getElementById('hiddenInstituteId').value = instituteId;

    const form = document.getElementById('applyForm');
    form.action = `/course/apply/${instituteId}`;

    document.getElementById('programmeModal').style.display = 'flex';
}

function closeProgrammeModal() {
    document.getElementById('programmeModal').style.display = 'none';
}

function openApplyModal() {
    document.getElementById('programmeModal').style.display = 'none';
    document.getElementById('applyModal').style.display = 'flex';
}

function closeApplyModal() {
    document.getElementById('applyModal').style.display = 'none';
}

function openMoreInfoModal() {
    const modal = document.getElementById('infoModal');
    const messageEl = document.getElementById('infoMessage');

    messageEl.innerHTML = `If you want more information about this post, please call the institute at: <strong>${currentInstitutePhone}</strong>`;
    modal.style.display = 'flex';
}

function closeInfoModal() {
    document.getElementById('infoModal').style.display = 'none';
}
</script>

</body>
</html>
