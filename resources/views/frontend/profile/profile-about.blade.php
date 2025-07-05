@include('frontend.profile.profile-view')

<style>
    /* Modal Overlay */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

/* Modal Content */
.modal-content {
    background: #ffffff;
    border-radius: 10px;
    width: 100%;
    max-width: 500px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
    animation: scaleUp 0.3s ease-in-out;
}

/* Modal Header */
.modal-header {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

/* Modal Close Button */
.modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #333;
}

/* Form Group */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #555;
    margin-bottom: 8px;
}

textarea,
input[type="file"] {
    width: 100%;
    padding: 20px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

textarea {
    resize: none;
}

input[type="file"] {
    padding: 5px;
}

/* Submit Button */
.confirm-btn {
    display: inline-block;
    background-color: #007bff;
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

.confirm-btn:hover {
    background-color: #0056b3;
}

/* Show Modal */
.modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

/* Animation */
@keyframes scaleUp {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* About Button */
.about-btn {
    display: inline-block;
    background-color: #007bff;
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.2s ease;
    
}

.about-btn:hover {
    background-color: #0056b3;
    transform: scale(1.05); /* Slight zoom on hover */
}

.about-btn:active {
    background-color: #003f8c;
    transform: scale(0.95); /* Slight shrink on click */
}


.image-preview-container {
    margin-top: 10px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.image-preview-container img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 2px solid #ddd;
    border-radius: 5px;
}


/* About Section Container */
.about-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    
    padding: 20px;
    border-radius: 10px;
    
    margin-bottom: 20px;
}

.modal-content textarea {
    width: 450px; /* Full width of the modal */
    height: 150px; /* Default height for all text areas */
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    resize: vertical; /* Users can resize only vertically */
}

.reset-btn {
    display: inline-block;
    background-color: #ffc107;
    color: #000000;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

.reset-btn:hover {
    background-color: #e0a800; /* Darker yellow on hover */
}

.reset-btn:focus {
    outline: none;
}

/* General Container */
.about-section {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.institute-title {
    text-align: center;
    font-size: 2.5em;
    margin-bottom: 40px;
    color: #1e3d58;
}

/* General Container */
.about-section {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
}

.institute-title {
    text-align: center;
    font-size: 2.8em;
    margin-bottom: 40px;
    color: #2a4d6c;
    font-weight: bold;
}





/* General Container */
.about-section {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    margin-top: -50px;
}

.institute-title {
    text-align: center;
    font-size: 2.8em;
    margin-bottom: 40px;
    color: #2a4d6c;
    font-weight: bold;
}

/* Section Styles */
.about-content {
   
    border-radius: 10px;
    padding: 40px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}


/* Overview Section */
.overview {
    margin-bottom: 40px;
    justify-content: space-between;
}

.overview h2 {
    font-size: 2em;
    color: #2a4d6c;
}

.overview-text {
    font-size: 1.1em;
    line-height: 1.7;
    color: #333;
}

/* Mission and Vision */
.mission-vision {
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
    margin-top: 40px; /* Added space before Mission/Vision */
}

.mission,
.vision {
    width: 48%;
}

.mission h3,
.vision h3 {
    font-size: 1.8em;
    color: #2a4d6c;
}

.mission p,
.vision p {
    font-size: 1.1em;
    line-height: 1.6;
    color: #555;
}

/* General Styling */

/* Chancellor & Vice Chancellor */
.chancellor-intro,
.vice-chancellor-intro {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
}

.chancellor-photo,
.vice-chancellor-photo {
    width: 3500px;
    height: 100%;
    margin-right: 30px;
    border-radius: 10%;
    overflow: hidden; /* Hide overflow to maintain circular shape */
}

.chancellor-photo img,
.vice-chancellor-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures image fills the circle without distortion */
    object-position: center; /* Center image inside the container */
}

/* Description Section */
.chancellor-description,
.vice-chancellor-description {
    flex-grow: 1;
}

.chancellor-description h3,
.vice-chancellor-description h3 {
    font-size: 1.6em;
    color: #2a4d6c;
}

.chancellor-description p,
.vice-chancellor-description p {
    font-size: 1em;
    color: #555;
}

/* Add some spacing before the description */
.chancellor-description,
.vice-chancellor-description {
    margin-top: 10px;
}

/* Add space between each section */
.chancellor-intro,
.vice-chancellor-intro {
    margin-top: 40px;
}


/* Divider Line */
.divider {
    margin: 40px 0;
    border: 0;
    border-top: 4px solid #e2e2e2;
}

/* Gallery (Images) */
.gallery {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.gallery img {
    width: 23%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Academic Excellence & Achievements */
.academic-excellence,
.programs-offered,
.global-partnerships,
.life-at-institute,
.sports-recreation,
.upcoming-programs {
    margin-top: 40px; /* Added space before each topic */
}

/* Campus Overview */
.campus-overview {
    margin-top: 40px; /* Added space before Campus Overview */
}

.campus-overview h3 {
    font-size: 2em;
    color: #2a4d6c;
}

.campus-overview .gallery {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.campus-overview .gallery img {
    width: 30%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px
}

h2, h3 {
    margin-bottom: 15px; /* Add space below each topic title */
    font-size: 1.8em;
    
}

/* Adding space between topic title and description (e.g., Institute Overview, Mission, Vision) */
p {
    margin-top: 10px;
    margin-bottom: 20px; /* Space between the paragraph and the next topic */
    font-size: 1.1em;
    text-align: justify; 
    
}







/* Modal Overlay */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.modal-overlay.active {
    visibility: visible;
    opacity: 1;
}

/* Modal Content */
.modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 900px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    overflow-y: auto;
}

/* Close Button */
.modal-close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 30px;
    background: none;
    border: none;
    color: #333;
    cursor: pointer;
}

/* Modal Header */
.modal-header {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
}

/* Modal Body */
.modal-body {
    display: flex;
    flex-direction: column;
}

/* Form Group */
.form-group {
    margin-bottom: 20px;
}

/* Label */
.form-group label {
    font-weight: 600;
    margin-bottom: 5px;
    display: inline-block;
}

/* Textarea */
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    resize: vertical;
}

/* File Input */
.form-group input[type="file"] {
    margin-top: 5px;
}

/* Image Preview */
.form-group img {
    margin-top: 10px;
    max-width: 100px;
    max-height: 100px;
    border-radius: 5px;
}

/* Submit Button */
.submit-btn {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.submit-btn:hover {
    background-color: #45a049;
}






/* Modal overlay styling */
.delete-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
    justify-content: center;
    align-items: center;
}

/* Modal content styling */
.delete-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    width: 400px;
    text-align: center;
    position: relative;
}

/* Modal header styling */
.delete-modal-header {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 15px;
}

/* Modal body styling */
.delete-modal-body {
    margin-bottom: 20px;
}

/* Buttons styling */
.delete-modal-confirm-btn {
    background-color: #e53935;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-right: 10px;
}

.delete-modal-cancel-btn {
    background-color: #9e9e9e;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.delete-modal-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

/* About Container */
.about-container {
    display: flex;
    align-items: center;
    gap: 10px; /* Reduced gap between buttons */
    margin-bottom: 20px; /* Optional: Space below the container */
}


/* Modal and Delete Buttons */
.open-modal-btn {
    background-color: #28a745; /* Green background for edit button */
    color: #ffffff; /* White text */
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.open-modal-btn:hover {
    background-color: #218838; /* Darker green on hover */
    transform: scale(1.05);
}

.open-modal-btn:active {
    background-color: #1e7e34; /* Even darker green on click */
    transform: scale(0.95);
}

.delete-btn {
    background-color: #dc3545; /* Red background for delete button */
    color: #ffffff; /* White text */
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.delete-btn:hover {
    background-color: #c82333; /* Darker red on hover */
    transform: scale(1.05);
}

.delete-btn:active {
    background-color: #bd2130; /* Even darker red on click */
    transform: scale(0.95);
}

@media (max-width: 768px) {
  /* Modal Content - smaller padding and full width */
  .modal-content,
  .delete-modal-content {
    width: 90%;
    max-width: 95%;
    padding: 15px;
    border-radius: 8px;
  }

  .modal-header,
  .delete-modal-header {
    font-size: 18px;
    
  }

  .modal-close,
  .delete-modal-close {
    font-size: 20px;
    top: 8px;
    right: 10px;
  }

  .form-group label {
    font-size: 14px;
  }

  textarea,
  input[type="file"] {
    font-size: 14px;
    padding: 10px;
  }

  /* Image Preview Adjustments */
  .image-preview-container {
    gap: 8px;
    justify-content: center;
  }

  .image-preview-container img {
    width: 80px;
    height: 80px;
  }

  /* Buttons */
  .submit-btn,
  .reset-btn,
  .confirm-btn,
  .open-modal-btn,
  .delete-btn {
    font-size: 14px;
    padding: 8px 15px;
    width: 100%; /* Full width on small screens */
    margin-bottom: 10px;
  }

  /* About Section */
  .about-container {
    flex-direction: column;
    align-items: stretch;
    gap: 15px;
    
  }

  .about-container h1 {
    display: none;
  }
  
  .modal-content textarea {
    width: 100%;
    height: 120px;
    font-size: 14px;
  }

  /* Chancellor / VC Intro Layout */
  .chancellor-intro,
  .vice-chancellor-intro {
    flex-direction: column;
    text-align: center;
  }

  .chancellor-photo,
  .vice-chancellor-photo {
    width: 100%;
    height: auto;
    margin-right: 0;
    margin-bottom: 15px;
  }

  .chancellor-description,
  .vice-chancellor-description {
    margin-top: 0;
  }

  /* Gallery images */
  .gallery img {
    width: 100%;
    height: auto;
  }

  .campus-overview .gallery img {
    width: 100%;
  }
}





</style>

<!-- Create Your Own About Button -->
<div class="about-container">
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1> <h1></h1>
    <h1></h1><h1></h1> 
    
    
    
    @if(Auth::check() && Auth::user()->role === 'Institute' && Auth::user()->id === $institute->user_id)
    <button class="about-btn">Create Your Own About</button>
    <button class="open-modal-btn" onclick="toggleModal('updateAboutModal')">✏️</button>
    <button type="button" class="delete-btn" onclick="openDeleteModal('{{ route('institute.destroy', $institute->id) }}')">🗑️</button>
    @endif
</div>


<!-- Modal Structure -->
<!-- Modal -->
<div class="modal-overlay">
    <div class="modal-content">
        <button class="modal-close">&times;</button>
        <div class="modal-header">Create Your Own About</div>
        <div class="modal-body">
            <form id="aboutForm" action="{{ route('about.submit', ['id' => $institute->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                <!-- Institute Overview -->
                <div class="form-group">
                    <label for="instituteOverview">Institute Overview</label>
                    <textarea id="instituteOverview" name="institute_overview" rows="4" placeholder="This is the introduction to the institute. It should provide a brief description of the institution, including its goals.."></textarea>
                </div>

                <!-- Mission -->
                <div class="form-group">
                    <label for="mission">Mission</label>
                    <textarea id="mission" name="mission" rows="4" placeholder="Write about the mission..."></textarea>
                </div>

                <!-- Vision -->
                <div class="form-group">
                    <label for="vision">Vision</label>
                    <textarea id="vision" name="vision" rows="4" placeholder="Write about the vision..."></textarea>
                </div>

                <!-- History -->
                <div class="form-group">
                    <label for="history">History</label>
                    <textarea id="history" name="history" rows="4" placeholder="This is the introduction to the institute. It should provide a brief description of the institution, including its goals..."></textarea>
                </div>

                <!-- Chancellor Introduction -->
                <div class="form-group">
                    <label for="chancellorIntro">Chancellor Introduction</label>
                    <textarea id="chancellorIntro" name="chancellor_intro" rows="3" placeholder="Write about the chancellor..."></textarea>
                    <label for="chancellorPhoto">Chancellor Photo</label>
                    <input type="file" id="chancellorPhoto" name="chancellor_photo" accept="image/*">
                </div>

                <!-- Vice-Chancellor Introduction -->
                <div class="form-group">
                    <label for="viceChancellorIntro">Vice-Chancellor Introduction</label>
                    <textarea id="viceChancellorIntro" name="vice_chancellor_intro" rows="3" placeholder="Write about the vice-chancellor..."></textarea>
                    <label for="viceChancellorPhoto">Vice-Chancellor Photo</label>
                    <input type="file" id="viceChancellorPhoto" name="vice_chancellor_photo" accept="image/*">
                </div>

                <!-- Academic Excellence & Achievements -->
                <div class="form-group">
                    <label for="academicExcellence">Academic Excellence & Achievements</label>
                    <textarea id="academicExcellence" name="academic_excellence" rows="4" placeholder="Write about the institute's academic achievements, teaching methodologies, and standout programs...
                    
Include photos from classrooms, labs, or lectures to visually represent the institute’s academic environment."></textarea>
                    <label for="academicImages">Upload Related Images</label>
                    <input type="file" id="academicImages" name="academic_images[]" accept="image/*" multiple>
                </div>

                <!-- Programs Offered -->
                <div class="form-group">
                    <label for="programsOffered">Programs Offered</label>
                    <textarea id="programsOffered" name="programs_offered" rows="4" placeholder="Write about the Detail of different academic programs, degrees, and diplomas offered by the institute...
                    
Use images that represent each program, such as graduation ceremonies, class activities, or project works."></textarea>
                    <label for="programsImages">Upload Related Images</label>
                    <input type="file" id="programsImages" name="programs_images[]" accept="image/*" multiple>
                </div>

                <!-- Global Partnerships -->
                <div class="form-group">
                    <label for="globalPartnerships">Global Partnerships</label>
                    <textarea id="globalPartnerships" name="global_partnerships" rows="4" placeholder="Mention partnerships with universities, research organizations, and international institutions...
Display logos or photos from global collaborations, international exchange programs, or photos from partner events."></textarea>
                    <label for="partnershipsImages">Upload Related Images</label>
                    <input type="file" id="partnershipsImages" name="partnerships_images[]" accept="image/*" multiple>
                </div>

                <!-- Life at [Institute Name] -->
                <div class="form-group">
                    <label for="lifeAtInstitute">Life at {{ $institute->institute_name }}</label>
                    <textarea id="lifeAtInstitute" name="life_at_institute" rows="4" placeholder="Describe student life, extracurricular activities, and campus culture...
Use vibrant images of campus life, including events, student clubs, and gatherings."></textarea>
                    <label for="lifeImages">Upload Related Images</label>
                    <input type="file" id="lifeImages" name="life_images[]" accept="image/*" multiple>
                </div>

                <!-- Sports & Recreation -->
                <div class="form-group">
                    <label for="sportsRecreation">Sports & Recreation</label>
                    <textarea id="sportsRecreation" name="sports_recreation" rows="4" placeholder="Explain the sports and recreation facilities available to students and highlight any sports teams...
Add photos of sports events, student athletes in action, or images of recreational facilities like gymnasiums or swimming pools."></textarea>
                    <label for="sportsImages">Upload Related Images</label>
                    <input type="file" id="sportsImages" name="sports_images[]" accept="image/*" multiple>
                </div>

                <!-- Upcoming Programs & Developments -->
                <div class="form-group">
                    <label for="upcomingPrograms">Upcoming Programs & Developments</label>
                    <textarea id="upcomingPrograms" name="upcoming_programs" rows="4" placeholder="Highlight future educational programs, new initiatives, or campus developments...
Show images of construction sites for new buildings or renderings of new campus facilities."></textarea>
                    <label for="upcomingImages">Upload Related Images</label>
                    <input type="file" id="upcomingImages" name="upcoming_images[]" accept="image/*" multiple>
                </div>

                <!-- Campus Overview -->
                <div class="form-group">
                    <label for="campusImages">Campus Overview Images <br> (Include wide-angle photos of the campus, individual buildings, or detailed shots of specific facilities.)</label>
                    <input type="file" id="campusImages" name="campus_images[]" accept="image/*" multiple>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="confirm-btn">Save About Section</button>
                <button type="reset" class="reset-btn" id="resetForm">Reset</button>
            </form>
        </div>
    </div>
</div>





<div class="container about-section">
    @if ($aboutSection)
        <section class="about-content">
            
            <!-- Institute Overview -->
            @if ($aboutSection->institute_overview)
                <div class="overview">
                    <div class="buttons">
                    <h2>Institute Overview</h2>
                    <p class="overview-text">{!! nl2br(e($aboutSection->institute_overview)) !!}</p>
                </div>
            @endif

            <!-- Mission and Vision -->
            <div class="mission-vision">
                @if ($aboutSection->mission)
                    <div class="section mission">
                        <h3>Mission</h3>
                        <p>{!! nl2br(e($aboutSection->mission)) !!}</p>
                    </div>
                @endif

                @if ($aboutSection->vision)
                    <div class="section vision">
                        <h3>Vision</h3>
                        <p>{!! nl2br(e($aboutSection->vision)) !!}</p>
                    </div>
                @endif
            </div>

            <hr class="divider">

            <!-- History -->
            @if ($aboutSection->history)
                <div class="section history">
                    <h3>History</h3>
                    <p>{!! nl2br(e($aboutSection->history)) !!}</p>
                </div>
            @endif

            <hr class="divider">

            <!-- Chancellor Introduction -->
            @if ($aboutSection->chancellor_intro)
                <div class="chancellor-intro">
                    <div class="chancellor-photo">
                        @if ($aboutSection->chancellor_photo)
                            <img src="{{ asset('storage/' . $aboutSection->chancellor_photo) }}" alt="Chancellor Photo">
                        @endif
                    </div>
                    <div class="chancellor-description">
                        <h3>Chancellor Introduction</h3>
                        <p>{!! nl2br(e($aboutSection->chancellor_intro)) !!}</p>
                    </div>
                </div>
            @endif

            <!-- Vice Chancellor Introduction -->
            @if ($aboutSection->vice_chancellor_intro)
                <div class="vice-chancellor-intro">
                    <div class="vice-chancellor-photo">
                        @if ($aboutSection->vice_chancellor_photo)
                            <img src="{{ asset('storage/' . $aboutSection->vice_chancellor_photo) }}" alt="Vice-Chancellor Photo">
                        @endif
                    </div>
                    <div class="vice-chancellor-description">
                        <h3>Vice-Chancellor Introduction</h3>
                        <p>{!! nl2br(e($aboutSection->vice_chancellor_intro)) !!}</p>
                    </div>
                </div>
            @endif

            <hr class="divider">

            <!-- Academic Excellence -->
            @if ($aboutSection->academic_excellence)
                <div class="section academic-excellence">
                    <h3>Academic Excellence & Achievements</h3>
                    <p>{!! nl2br(e($aboutSection->academic_excellence)) !!}</p>
                    @if ($aboutSection->academic_images)
                        <div class="gallery">
                            @foreach (json_decode($aboutSection->academic_images) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Academic Image">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Programs Offered -->
            @if ($aboutSection->programs_offered)
                <div class="section programs-offered">
                    <h3>Programs Offered</h3>
                    <p>{!! nl2br(e($aboutSection->programs_offered)) !!}</p>
                    @if ($aboutSection->programs_images)
                        <div class="gallery">
                            @foreach (json_decode($aboutSection->programs_images) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Programs Image">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Global Partnerships -->
            @if ($aboutSection->global_partnerships)
                <div class="section global-partnerships">
                    <h3>Global Partnerships</h3>
                    <p>{!! nl2br(e($aboutSection->global_partnerships)) !!}</p>
                    @if ($aboutSection->partnerships_images)
                        <div class="gallery">
                            @foreach (json_decode($aboutSection->partnerships_images) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Partnerships Image">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Life at Institute -->
            @if ($aboutSection->life_at_institute)
                <div class="section life-at-institute">
                    <h3>Life at {{ $institute->name }}</h3>
                    <p>{!! nl2br(e($aboutSection->life_at_institute)) !!}</p>
                    @if ($aboutSection->life_images)
                        <div class="gallery">
                            @foreach (json_decode($aboutSection->life_images) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Life Image">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Sports & Recreation -->
            @if ($aboutSection->sports_recreation)
                <div class="section sports-recreation">
                    <h3>Sports & Recreation</h3>
                    <p>{!! nl2br(e($aboutSection->sports_recreation)) !!}</p>
                    @if ($aboutSection->sports_images)
                        <div class="gallery">
                            @foreach (json_decode($aboutSection->sports_images) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Sports Image">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <!-- Upcoming Programs & Developments -->
            @if ($aboutSection->upcoming_programs)
                <div class="section upcoming-programs">
                    <h3>Upcoming Programs & Developments</h3>
                    <p>{!! nl2br(e($aboutSection->upcoming_programs)) !!}</p>
                    @if ($aboutSection->upcoming_images)
                        <div class="gallery">
                            @foreach (json_decode($aboutSection->upcoming_images) as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Upcoming Image">
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            <hr class="divider">

            <!-- Campus Overview -->
            @if ($aboutSection->campus_images)
                <div class="section campus-overview">
                    <h3>Campus Overview</h3>
                    <div class="gallery">
                        @foreach (json_decode($aboutSection->campus_images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Campus Image">
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @else
        <p>No Data</p>
    @endif
</div>



<!-- Update Modal -->
<div class="modal-overlay" id="updateAboutModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal('updateAboutModal')">&times;</button>  <!-- Close button -->
        <div class="modal-header">Update Your About</div>
        <div class="modal-body">
            <form id="updateAboutForm" action="{{ route('institute.update', $institute->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- To make it an update request -->

                <!-- Institute Overview -->
                <div class="form-group">
                    <label for="instituteOverview">Institute Overview</label>
                    <textarea id="instituteOverview" name="institute_overview" rows="4" placeholder="This is the introduction to the institute.">{{ $aboutSection->institute_overview }}</textarea>
                </div>

                <!-- Mission -->
                <div class="form-group">
                    <label for="mission">Mission</label>
                    <textarea id="mission" name="mission" rows="4" placeholder="Write about the mission...">{{ $aboutSection->mission }}</textarea>
                </div>

                <!-- Vision -->
                <div class="form-group">
                    <label for="vision">Vision</label>
                    <textarea id="vision" name="vision" rows="4" placeholder="Write about the vision...">{{ $aboutSection->vision }}</textarea>
                </div>

                <!-- History -->
                <div class="form-group">
                    <label for="history">History</label>
                    <textarea id="history" name="history" rows="4" placeholder="This is the introduction to the institute.">{{ $aboutSection->history }}</textarea>
                </div>

                <!-- Chancellor Introduction -->
                <div class="form-group">
                    <label for="chancellorIntro">Chancellor Introduction</label>
                    <textarea id="chancellorIntro" name="chancellor_intro" rows="3" placeholder="Write about the chancellor...">{{ $aboutSection->chancellor_intro }}</textarea>
                    <label for="chancellorPhoto">Chancellor Photo</label>
                    <input type="file" id="chancellorPhoto" name="chancellor_photo" accept="image/*">
                    @if ($aboutSection->chancellor_photo)
                        <img src="{{ asset('storage/' . $aboutSection->chancellor_photo) }}" alt="Chancellor Photo" width="100" height="100">
                    @endif
                </div>

                <!-- Vice-Chancellor Introduction -->
                <div class="form-group">
                    <label for="viceChancellorIntro">Vice-Chancellor Introduction</label>
                    <textarea id="viceChancellorIntro" name="vice_chancellor_intro" rows="3" placeholder="Write about the vice-chancellor...">{{ $aboutSection->vice_chancellor_intro }}</textarea>
                    <label for="viceChancellorPhoto">Vice-Chancellor Photo</label>
                    <input type="file" id="viceChancellorPhoto" name="vice_chancellor_photo" accept="image/*">
                    @if ($aboutSection->vice_chancellor_photo)
                        <img src="{{ asset('storage/' . $aboutSection->vice_chancellor_photo) }}" alt="Vice-Chancellor Photo" width="100" height="100">
                    @endif
                </div>

                <!-- Academic Excellence & Achievements -->
                <div class="form-group">
                    <label for="academicExcellence">Academic Excellence & Achievements</label>
                    <textarea id="academicExcellence" name="academic_excellence" rows="4" placeholder="Write about the institute's academic achievements, teaching methodologies, and standout programs...">{{ $aboutSection->academic_excellence }}</textarea>
                    <label for="academicImages">Upload Related Images</label>
                    <input type="file" id="academicImages" name="academic_images[]" accept="image/*" multiple>
                </div>

                <!-- Programs Offered -->
                <div class="form-group">
                    <label for="programsOffered">Programs Offered</label>
                    <textarea id="programsOffered" name="programs_offered" rows="4" placeholder="Write about the details of different academic programs, degrees, and diplomas offered by the institute...">{{ $aboutSection->programs_offered }}</textarea>
                    <label for="programsImages">Upload Related Images</label>
                    <input type="file" id="programsImages" name="programs_images[]" accept="image/*" multiple>
                </div>

                <!-- Global Partnerships -->
                <div class="form-group">
                    <label for="globalPartnerships">Global Partnerships</label>
                    <textarea id="globalPartnerships" name="global_partnerships" rows="4" placeholder="Mention partnerships with universities, research organizations, and international institutions...">{{ $aboutSection->global_partnerships }}</textarea>
                    <label for="partnershipsImages">Upload Related Images</label>
                    <input type="file" id="partnershipsImages" name="partnerships_images[]" accept="image/*" multiple>
                </div>

                <!-- Life at Institute -->
                <div class="form-group">
                    <label for="lifeAtInstitute">Life at {{ $aboutSection->institute_name }}</label>
                    <textarea id="lifeAtInstitute" name="life_at_institute" rows="4" placeholder="Describe student life, extracurricular activities, and campus culture...">{{ $aboutSection->life_at_institute }}</textarea>
                    <label for="lifeImages">Upload Related Images</label>
                    <input type="file" id="lifeImages" name="life_images[]" accept="image/*" multiple>
                </div>

                <!-- Sports & Recreation -->
                <div class="form-group">
                    <label for="sportsRecreation">Sports & Recreation</label>
                    <textarea id="sportsRecreation" name="sports_recreation" rows="4" placeholder="Explain the sports and recreation facilities available to students and highlight any sports teams...">{{ $aboutSection->sports_recreation }}</textarea>
                    <label for="sportsImages">Upload Related Images</label>
                    <input type="file" id="sportsImages" name="sports_images[]" accept="image/*" multiple>
                </div>

                <!-- Upcoming Programs & Developments -->
                <div class="form-group">
                    <label for="upcomingPrograms">Upcoming Programs & Developments</label>
                    <textarea id="upcomingPrograms" name="upcoming_programs" rows="4" placeholder="Highlight future educational programs, new initiatives, or campus developments...">{{ $aboutSection->upcoming_programs }}</textarea>
                    <label for="upcomingImages">Upload Related Images</label>
                    <input type="file" id="upcomingImages" name="upcoming_images[]" accept="image/*" multiple>
                </div>

                <!-- Campus Overview -->
                <div class="form-group">
                    <label for="campusImages">Campus Overview Images <br> (Include wide-angle photos of the campus, individual buildings, or detailed shots of specific facilities.)</label>
                    <input type="file" id="campusImages" name="campus_images[]" accept="image/*" multiple>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">Update About Section</button>
                <button type="reset" class="reset-btn" id="resetForm">Reset</button>
            </form>
        </div>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div class="delete-modal" id="deleteModal">
    <div class="delete-modal-content">
        <button class="delete-modal-close" onclick="closeDeleteModal()">&times;</button>
        <div class="delete-modal-header">Confirm Deletion</div>
        <div class="delete-modal-body">
            <p>Are you sure you want to delete this institute's information?</p>
            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-modal-confirm-btn">Yes, Delete</button>
                <button type="button" class="delete-modal-cancel-btn" onclick="closeDeleteModal()">Cancel</button>
            </form>
        </div>
    </div>
</div>





<script>
// Get modal elements
const modalOverlay = document.querySelector('.modal-overlay');
const openModalBtn = document.querySelector('.about-btn'); // Ensure this button exists in your HTML
const closeModalBtn = document.querySelector('.modal-close');
const form = document.getElementById('aboutForm');

// Open Modal
if (openModalBtn) {
    openModalBtn.addEventListener('click', () => {
        modalOverlay.classList.add('show'); // Show the modal
    });
}

// Close Modal
closeModalBtn.addEventListener('click', () => {
    modalOverlay.classList.remove('show'); // Hide the modal
});

// Close modal if clicking outside of the modal content
modalOverlay.addEventListener('click', (event) => {
    if (event.target === modalOverlay) {
        modalOverlay.classList.remove('show');
    }
});

// Consolidate form reset logic into one event listener
document.addEventListener("DOMContentLoaded", () => {
    const resetFormButton = document.getElementById("resetForm");
    const aboutForm = document.getElementById("aboutForm");

    resetFormButton.addEventListener("click", () => {
        // Reset all standard fields
        aboutForm.reset();

        // Clear all file inputs manually
        const fileInputs = aboutForm.querySelectorAll('input[type="file"]');
        fileInputs.forEach((fileInput) => {
            fileInput.value = ''; // Clear the value of file inputs

            // Clear the corresponding preview container if any
            const previewContainer = document.querySelector(`#${fileInput.id}Preview`);
            if (previewContainer) {
                previewContainer.innerHTML = ''; // Clear previews
            }
        });
    });

    // Handle image preview logic for all file inputs
    const fileInputs = aboutForm.querySelectorAll('input[type="file"]');
    fileInputs.forEach((fileInput) => {
        fileInput.addEventListener("change", (event) => {
            const previewContainerId = `${fileInput.id}Preview`;
            let previewContainer = document.getElementById(previewContainerId);

            // Create a preview container if not already present
            if (!previewContainer) {
                previewContainer = document.createElement("div");
                previewContainer.id = previewContainerId;
                previewContainer.classList.add("image-preview-container");
                fileInput.insertAdjacentElement("afterend", previewContainer);
            }

            // Clear any existing previews
            previewContainer.innerHTML = '';

            // Render previews for selected images
            Array.from(fileInput.files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.alt = file.name;
                    img.classList.add("preview-image");
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    });
});



//Update modal js

// Function to toggle modal visibility by passing modal ID
function toggleModal(modalId) {
    var modal = document.querySelector(`#${modalId}`); // Get modal by its ID
    modal.classList.toggle('active');  // Toggle the 'active' class to show/hide modal
}

// Function to close the modal (called when '×' is clicked)
function closeModal(modalId) {
    var modal = document.querySelector(`#${modalId}`);
    modal.classList.remove('active');  // Remove 'active' class to hide the modal
}

// Function to close modal when clicking outside the modal content (clicks on the overlay)
window.addEventListener('click', function(event) {
    var modal = document.querySelector('.modal-overlay');
    if (event.target === modal) {  // Check if clicked outside the modal content (on overlay)
        closeModal('updateAboutModal');  // Close the modal
    }
});

// Reset form when the reset button is clicked
document.getElementById('resetForm').addEventListener('click', function() {
    document.getElementById('updateAboutForm').reset(); // Reset the form fields
});





// Function to open the delete modal
function openDeleteModal(actionUrl) {
    // Set the action of the delete form dynamically
    document.getElementById('deleteForm').action = actionUrl;

    // Show the modal
    const modal = document.getElementById('deleteModal');
    modal.style.display = 'flex';
}

// Function to close the delete modal
function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.style.display = 'none';
}




</script>