<!-- Center Section: Posts -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="center-section">
    {{-- <button class="post-upload-btn">
    @if(Auth::check() && Auth::user()->role === 'Institute' && Auth::user()->id === $institute->user_id)
        <a href="{{ route('posts.create', ['id' => $institute->id]) }}" class="">Add Post</a>
    @endif
</button> --}}
    
<div class="uploaded-posts">
    
    @if($posts->isEmpty())
    <p>No posts available.</p>
@else
    @foreach($posts as $post)
        <div class="post">
            <!-- Post Header -->
            <div class="post-header">
                <img src="{{ $post->institute->profile_photo ? asset('storage/' . $post->institute->profile_photo) : asset('images/default-profile.png') }}" 
                     alt="Profile Picture" 
                     style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                <div class="post-header-info">
                    <div class="post-header-top">
                        <h4 style="margin: 0; display: inline-block;">{{ $post->institute->institute_name }}</h4>
                        <!-- Edit and Delete Buttons -->
                        @if(Auth::check() && Auth::user()->id === $post->institute->user_id)
                        <div class="post-actions">
                          <button class="btn-edit" onclick="openEditPostModal('{{ route('posts.edit', $post->id) }}')">✏️</button>
                           
                          
                          <button type="button" class="btn-delete" onclick="openDeletePostModal('{{ $post->id }}', '{{ route('posts.destroy', $post->id) }}')">
                            🗑️
                        </button>
                        
                        
                        </div>
                        @endif

                    </div>
                    <span style="font-size: 12px; color: gray; display: block;">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>

            <!-- Post Body -->
            <div class="post-body">
                <h3>{{ $post->title }}</h3>
                <div class="post-description">
                    <p class="short-description">{!! nl2br(e(Str::limit($post->description, 200))) !!}</p>
                    <p class="full-description" style="display: none;">{!! nl2br(e($post->description)) !!}</p>
                    <button class="toggle-description-btn" onclick="toggleDescription(this)">See More...</button>
                </div><br>
                <span style="font-size: 14px; color: gray;"><strong>Location:</strong> {{ $post->location }}</span>
                <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/default-post.png') }}" 
                     alt="Post Image" 
                     class="post-image" 
                     style="margin-top: 10px; max-width: 100%; height: auto; border-radius: 8px;">
            </div>
            
            
        </div>
    @endforeach
@endif
</div>

</div>

{{-- edit post model --}}
<div id="editPostModal" class="modal">
    <div class="modal-overlay" onclick="closeEditPostModal()"></div>
    <div class="modal-content">
        <span class="close-btn" onclick="closeEditPostModal()">×</span>
        <h3 class="modal-title">Edit Post</h3>

        <form id="editPostForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="edit-title">Post Title</label>
                <input type="text" id="edit-title" name="title" required>
            </div>

            <div class="form-group">
                <label for="edit-small-description">Small Description</label>
                <textarea id="edit-small-description" name="small_description" required></textarea>
                <div id="characterCount">0/200 characters</div>
            </div>

            <div class="form-group">
                <label for="edit-description">Description</label>
                <textarea id="edit-description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="edit-image">Change Image</label>
                <input type="file" name="image" id="edit-image" accept="image/*">
                <img id="editImagePreview" src="#" alt="Image Preview" style="margin-top: 10px; max-width: 100%; height: auto; display: none;">
            </div>

            @php
                $dropdowns = [
                    'course_name' => 'Courses',
                    'course_type' => 'Course Type',
                    'location' => 'Location',
                    'duration' => 'Duration',
                    'course_format' => 'Course Format',
                    'attendance_type' => 'Attendance Type',
                ];
            @endphp

            @foreach($dropdowns as $field => $category)
            <div class="form-group">
                <label for="edit-{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                <select name="{{ $field }}" id="edit-{{ $field }}" required>
                    <option value="" disabled>Select {{ $category }}</option>
                    @foreach($categories as $item)
                        @if($item->main_category === $category)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @endforeach

            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Update Post</button>
                <button type="button" class="btn btn-cancel" onclick="closeEditPostModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>


<!-- Delete Post Modal -->
<div id="deletePostModal" class="delete-modal">
    <div class="modal-overlay" onclick="closeDeletePostModal()"></div>
    <div class="delete-modal-content">
        <span class="delete-close-btn" onclick="closeDeletePostModal()">×</span>
        <h3>Confirm Deletion</h3>
        <p>Are you sure you want to delete this post?</p>
        
        <div class="delete-modal-actions">
            <button type="button" class="delete-btn" id="confirmDeletePostBtn">Delete</button>
            <button type="button" class="cancel-btn" onclick="closeDeletePostModal()">Cancel</button>
        </div>
    </div>
</div>





<script>
    // Edit post modal
function openEditPostModal(editUrl) {
    fetch(editUrl)
        .then(response => response.json())
        .then(post => {
            document.getElementById('edit-title').value = post.title;
            document.getElementById('edit-small-description').value = post.small_description;
            document.getElementById('edit-description').value = post.description;

            // Show the current image preview (if available)
            if (post.image) {
                const preview = document.getElementById('editImagePreview');
                preview.src = `/storage/${post.image}`;
                preview.style.display = 'block';
            } else {
                document.getElementById('editImagePreview').style.display = 'none';
            }

            // Populate dropdowns
            document.getElementById('edit-course_name').value = post.course_name;
            document.getElementById('edit-course_type').value = post.course_type;
            document.getElementById('edit-location').value = post.location;
            document.getElementById('edit-duration').value = post.duration;
            document.getElementById('edit-course_format').value = post.course_format;
            document.getElementById('edit-attendance_type').value = post.attendance_type;

            // Set the form action URL for updating the post
            document.getElementById('editPostForm').action = `/posts/${post.id}`;

            // Show the modal
            document.getElementById('editPostModal').style.display = 'flex';
        })
        .catch(error => console.error('Error loading post:', error));
}

// Close the modal
function closeEditPostModal() {
    document.getElementById('editPostModal').style.display = 'none';
}

// Handle image preview when a new image is selected
document.getElementById('edit-image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('editImagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});


document.getElementById('small_description').addEventListener('input', function () {
    const maxLength = 200;
    const currentLength = this.value.length;
    const charCountDisplay = document.getElementById('characterCount');

    charCountDisplay.textContent = `${currentLength}/${maxLength} characters`;

    if (currentLength > maxLength) {
        this.value = this.value.substring(0, maxLength);
        charCountDisplay.textContent = `${maxLength}/${maxLength} characters`;
    }
});





// Function to open the delete modal
function openDeletePostModal(postId, deleteUrl) {
    const confirmDeleteBtn = document.getElementById('confirmDeletePostBtn');

    // Attach the delete action
    confirmDeleteBtn.onclick = function () {
        handlePostDeletion(postId, deleteUrl);
    };

    // Show the modal
    document.getElementById('deletePostModal').style.display = 'flex';
}

// Function to close the delete modal
function closeDeletePostModal() {
    document.getElementById('deletePostModal').style.display = 'none';
}

// Function to handle post deletion
function handlePostDeletion(postId, deleteUrl) {
    fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ id: postId })  // Send post ID as JSON payload
    })
        .then(response => response.json().then(data => ({ status: response.status, data })))
        .then(({ status, data }) => {
            if (status >= 200 && status < 300) {
                location.reload(); // Refresh the page after successful deletion
            } else {
                console.error('Error Response:', data);
                location.reload();
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert('An error occurred while deleting the post.');
        })
        .finally(() => {
            closeDeletePostModal();  // Close the modal after deletion attempt
        });
}



function toggleDescription(button) {
    const postBody = button.closest('.post-description');
    const shortDescription = postBody.querySelector('.short-description');
    const fullDescription = postBody.querySelector('.full-description');

    if (shortDescription.style.display === 'none') {
        shortDescription.style.display = 'block';
        fullDescription.style.display = 'none';
        button.textContent = 'See More...';
    } else {
        shortDescription.style.display = 'none';
        fullDescription.style.display = 'block';
        button.textContent = 'Show Less';
    }
}
</script>