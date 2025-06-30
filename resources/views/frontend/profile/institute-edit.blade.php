@include('frontend.profile.profile-view')
    
        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Toggle Arrow -->
            <div class="left-toggle-arrow" onclick="toggleLeftSidebar()">
               <i class="material-icons">chevron_right</i>
            </div>

            <!-- Left Section: Institute Gallery -->
            @include('frontend.profile.institute-gallery')
                
            <!-- Center Section: Posts -->
            @include('frontend.profile.profile-posts')
            
            <!-- Right Toggle Arrow -->
            <div class="right-toggle-arrow" onclick="toggleRightSidebar()">
               <i class="material-icons">chevron_left</i>
            </div>

            <!-- Right Section: Events -->
            @include('frontend.profile.profile-events')
        </div>
    </div>



{{-- Profile edit model --}}
<div id="editProfileModal" class="modal">
    <div class="modal-overlay" onclick="closeEditProfileModal()"></div>
    <div class="modal-content">
        <span class="close" onclick="closeEditProfileModal()">&times;</span>
        <h2>Edit Institute Profile</h2>
        <form id="editProfileForm" method="POST" action="{{ route('updateInstitute', ['id' => $institute->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-body">
                <!-- Left Side: Photos -->
                <div class="modal-left">
                    <div class="form-group">
                        <label for="profile_photo">Profile Photo:</label>
                        <div class="photo-preview">
                            <img src="{{ $institute->profile_photo ? asset('storage/' . $institute->profile_photo) : asset('images/default-profile.png') }}" id="profilePhotoPreview" alt="Profile Photo">
                        </div>
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" onchange="previewProfilePhoto()">
                    </div>
                    <div class="form-group">
                        <label for="cover_photo">Cover Photo:</label>
                        <div class="photo-preview">
                            <img src="{{ $institute->cover_photo ? asset('storage/' . $institute->cover_photo) : asset('images/default-cover.png') }}" id="coverPhotoPreview" alt="Cover Photo">
                        </div>
                        <input type="file" name="cover_photo" id="cover_photo" accept="image/*" onchange="previewCoverPhoto()">
                    </div>
                </div>

                <!-- Right Side: Editable Fields -->
                <div class="modal-right">
                    <div class="form-group">
                        <label for="institute_name">Institute Name:</label>
                        <input type="text" name="institute_name" id="institute_name" value="{{ $institute->institute_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location:</label>
                        <input type="text" name="location" id="location" value="{{ $institute->location }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $institute->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_number">Contact Number:</label>
                        <input type="text" name="contact_number" id="contact_number" value="{{ $institute->contact_number }}" required>
                    </div>
                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input type="text" name="website" id="website" value="{{ $institute->website }}">
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio:</label>
                        <textarea name="bio" id="bio" rows="3">{{ $institute->bio }}</textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn-primary">Save Changes</button>
                <button type="button" class="btn-cancel" onclick="closeEditProfileModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>
    
   
    
    <!-- Add Post Modal -->
<div id="addPostModal" class="modal">
    <div class="modal-overlay" onclick="closeAddPostModal()"></div>
    <div class="modal-content">
        <span class="close-btn" onclick="closeAddPostModal()">×</span>
        <h3 class="modal-title">Add New Post</h3>

        <!-- Add Post Form -->
        <form action="{{ route('posts.store', ['id' => $institute->id]) }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" id="title" name="title" placeholder="Enter title" required>
            </div>

            <!-- Image Upload -->
            <!-- Image Preview Section -->
            <div class="form-group">
                <label for="image">Image (1:1 Recommend)</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            <img id="imagePreview" src="#" alt="Image Preview" style="display:none; margin-top: 10px; max-width: 100%; height: auto;">
        </div>


        <div class="form-group">
            <label for="small_description">Small Description (For display in course card)</label>
            <textarea id="small_description" name="small_description" placeholder="Enter small description" maxlength="200" required></textarea>
            <div id="characterCount">0/200 characters</div>
        </div>
        

            <div class="form-group">
                <label for="description">Description (For display in profile)</label>
                <textarea id="description" name="description" placeholder="Enter description" required></textarea>
            </div>
            


            <!-- Course Name Dropdown -->
            <div class="form-group">
                <label for="course_name">Course Main Category</label>
                <select name="course_name" id="course_name" required>
                    <option value="" disabled selected>Select Main Category</option>
                    @foreach($categories as $category)
                        @if($category->main_category === 'Courses')
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Course Type Dropdown -->
            <div class="form-group">
                <label for="course_type">Course Type</label>
                <select name="course_type" id="course_type" required>
                    <option value="" disabled selected>Select Course Type</option>
                    @foreach($categories as $category)
                        @if($category->main_category === 'Course Type')
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Location Dropdown -->
            <div class="form-group">
                <label for="location">Location</label>
                <select name="location" id="location" required>
                    <option value="" disabled selected>Select Location</option>
                    @foreach($categories as $category)
                        @if($category->main_category === 'Location')
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Duration Dropdown -->
            <div class="form-group">
                <label for="duration">Duration</label>
                <select name="duration" id="duration" required>
                    <option value="" disabled selected>Select Duration</option>
                    @foreach($categories as $category)
                        @if($category->main_category === 'Duration')
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Course Format Dropdown -->
            <div class="form-group">
                <label for="course_format">Course Format</label>
                <select name="course_format" id="course_format" required>
                    <option value="" disabled selected>Select Course Format</option>
                    @foreach($categories as $category)
                        @if($category->main_category === 'Course Format')
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Attendance Type Dropdown -->
            <div class="form-group">
                <label for="attendance_type">Attendance Type</label>
                <select name="attendance_type" id="attendance_type" required>
                    <option value="" disabled selected>Select Attendance Type</option>
                    @foreach($categories as $category)
                        @if($category->main_category === 'Attendance Type')
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Add Post</button>
                <button type="button" class="btn btn-cancel" onclick="closeAddPostModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>
    




{{-- //Add event --}}
<div id="addEventModal" class="modal">
    <div class="modal-overlay" onclick="closeAddEventModal()"></div>
    <div class="modal-content">
        <span class="close-btn" onclick="closeAddEventModal()">×</span>
        <h3 class="modal-title">Add Upcoming Event</h3>

        <!-- Add Event Form -->
        <form action="{{ route('events.store', ['id' => $institute->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="event_title">Event Title</label>
                <input type="text" id="event_title" name="event_title" placeholder="Enter event title" required>
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label for="event_image">Event Image</label>
                <input type="file" name="event_image" id="event_image" accept="image/*" required>
                <img id="eventImagePreview" src="#" alt="Event Image Preview" style="display:none; margin-top: 10px; max-width: 100%; height: auto;">
            </div>

            <div class="form-group">
                <label for="event_description">Event Description</label>
                <textarea id="event_description" name="event_description" placeholder="Enter event description" required></textarea>
            </div>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" id="event_date" name="event_date" required>
            </div>

            <div class="form-group">
                <label for="sub_location">Location</label>
                <textarea id="sub_location" name="sub_location" placeholder="Enter location details" required></textarea>
            </div>

            <div class="form-group">
                <label for="main_location">Sub Location</label>
                <textarea id="main_location" name="main_location" placeholder="Enter sub Location" required></textarea>
            </div>

            

            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Add Event</button>
                <button type="button" class="btn btn-cancel" onclick="closeAddEventModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>







<script>


    // Profile edit model
    function openModal() {
        document.getElementById('editProfileModal').style.display = 'flex';
    }

     
    function previewProfilePhoto() {
        const file = document.getElementById('profile_photo').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profilePhotoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    function previewCoverPhoto() {
        const file = document.getElementById('cover_photo').files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('coverPhotoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    function closeEditProfileModal() {
        document.getElementById('editProfileModal').style.display = 'none';
    }





// Open Add Post Modal
function openAddPostModal() {
    document.getElementById('addPostModal').style.display = 'flex';
}

// Close Add Post Modal
function closeAddPostModal() {
    document.getElementById('addPostModal').style.display = 'none';
}
// JavaScript to preview the uploaded image
document.getElementById('image').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('imagePreview');
        preview.src = reader.result;
        preview.style.display = 'block';  // Make the preview visible
    };
    reader.readAsDataURL(event.target.files[0]);
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







// Open the Add Event Modal and update the URL
function openAddEventModal() {
    document.getElementById('addEventModal').style.display = 'flex';
    
}

// Close the Add Event Modal and revert the URL
function closeAddEventModal() {
    document.getElementById('addEventModal').style.display = 'none';
    
}

// Preview the uploaded event image
document.getElementById('event_image').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const preview = document.getElementById('eventImagePreview');
        preview.src = reader.result;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
});


function toggleLeftSidebar() {
  const leftSidebar = document.querySelector('.left-section');
  const icon = document.querySelector('.left-toggle-arrow i');

  leftSidebar.classList.toggle('active');
  icon.classList.toggle('active');
}


function toggleRightSidebar() {
  const rightSidebar = document.querySelector('.right-section');
  const icon = document.querySelector('.right-toggle-arrow i');

  rightSidebar.classList.toggle('active');
  icon.classList.toggle('active');
}


</script>
 