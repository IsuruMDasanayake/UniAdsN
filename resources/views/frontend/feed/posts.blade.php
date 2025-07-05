<div class="tab-container">
    {{-- <div class="tabs">
        <span class="tab active">RECENT</span>
        <span class="tab">POPULAR</span>
        <span class="tab">MOST VIEW</span>
    </div>
    <div class="underline"></div> --}}
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="post-card-container" id="post-container">
    @include('frontend.feed.post_partial', ['posts' => $posts])
</div>

<div id="loading" style="text-align: center; display: none;">
    <p>Loading more posts...</p>
</div>






<!-- Main Modal -->
<div id="postModal" class="post-modal">
  <div class="post-modal-content">
    <span class="post-close-btn" onclick="closePostModal()">&times;</span>
    <img id="postImage" class="post-image" src="" alt="Post Image" />
    <h3 id="postTitle" class="post-title"></h3>
    <p id="postDescription" class="modal-description"></p>

    <!-- Footer Buttons -->
    <div class="post-footer">
      <button class="btn-primary" onclick="openApplyNowModal()">Apply Now</button>
      <button class="btn-secondary" onclick="openMoreInfoModal()">Get More Information</button>
    </div>
  </div>
</div>

<!-- Apply Now Modal -->
<div id="applyNowModal" class="post-modal">
  <div class="post-modal-content">
    <span class="post-close-btn" onclick="closeApplyNowModal()">&times;</span>
    <h3 id="applyModalTitle">Apply for Course</h3>

    <form id="applyNowForm" method="POST">
      @csrf
      <input type="hidden" name="course_title" id="applyCourseTitle">

      <div class="form-group">
        <label>Your Name</label>
        <input type="text" name="name" required>
      </div>

      <div class="form-group">
        <label>Your Email</label>
        <input type="email" name="email" required>
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" required>
      </div>

      <div class="form-group">
        <label>Message</label>
        <textarea name="message" rows="4" required></textarea>
      </div>

      <button type="submit" class="btn-primary">Send Message</button>
    </form>
  </div>
</div>

<!-- More Info Modal -->
<div id="moreInfoModal" class="post-modal">
  <div class="post-modal-content">
    <span class="post-close-btn" onclick="closeMoreInfoModal()">&times;</span>
    <p id="moreInfoText" class="modal-description">To get more information about this course, please call: <strong id="institutePhone"></strong></p>
  </div>
</div>



<script>
    function toggleLike(postId) {
    // Send a POST request to toggle like
    fetch(`/posts/${postId}/toggle-like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        // Update the like count dynamically
        const likeCountElement = document.querySelector(`.post-card[data-post-id="${postId}"] .post-timestamp`);
        if (likeCountElement) {
            likeCountElement.textContent = `${data.likes_count} Likes`;
        }

        // Update the button text dynamically
        const likeButton = document.querySelector(`.post-card[data-post-id="${postId}"] .like-button`);
        if (likeButton) {
            if (data.liked) {
                likeButton.innerHTML = '<span class="like-icon">👍</span> Liked';
            } else {
                likeButton.innerHTML = '<span class="like-icon">👍</span> Like';
            }
        }
    })
    .catch(error => console.error('Error liking post:', error));
}




function openPostModal(imageUrl, title, description, instituteId, institutePhone) {
  document.getElementById('postImage').src = imageUrl;
  document.getElementById('postTitle').textContent = title;
  document.getElementById('postDescription').textContent = description;

  // Store for use in Apply form
  currentInstituteId = instituteId;
  currentCourseTitle = title;

  // For info modal
  document.getElementById('institutePhone').textContent = institutePhone;

  document.getElementById('postModal').style.display = 'flex';
}


function closePostModal() {
    document.getElementById('postModal').style.display = 'none';
}




let currentInstituteId = null;
let currentCourseTitle = "";

function openPostModal(imageUrl, title, description, instituteId, institutePhone) {
  document.getElementById('postImage').src = imageUrl;
  document.getElementById('postTitle').textContent = title;
  document.getElementById('postDescription').textContent = description;

  // Store for use in Apply form
  currentInstituteId = instituteId;
  currentCourseTitle = title;

  // For info modal
  document.getElementById('institutePhone').textContent = institutePhone;

  document.getElementById('postModal').style.display = 'flex';
}

function closePostModal() {
  document.getElementById('postModal').style.display = 'none';
}




function openApplyNowModal() {
  document.getElementById('applyCourseTitle').value = currentCourseTitle;
  document.getElementById('applyNowForm').action = `/course/apply/${currentInstituteId}`;
  document.getElementById('applyNowModal').style.display = 'flex';
}

function closeApplyNowModal() {
  document.getElementById('applyNowModal').style.display = 'none';
}




function openMoreInfoModal() {
  document.getElementById('moreInfoModal').style.display = 'flex';
}

function closeMoreInfoModal() {
  document.getElementById('moreInfoModal').style.display = 'none';
}

</script>


    









