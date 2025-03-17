<div class="tab-container">
    <div class="tabs">
        <span class="tab active">RECENT</span>
        <span class="tab">POPULAR</span>
        <span class="tab">MOST VIEW</span>
    </div>
    <div class="underline"></div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="post-card-container">
    @forelse($posts as $post)
        <div class="post-card">
            <!-- Image Section -->
            <div class="post-image-wrapper">
                <img class="post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
            </div>

            <!-- Details Section -->
            <div class="post-details">
                <!-- Header -->
                <div class="post-header">
                    <img class="profile-picture" src="{{ asset('storage/' . ($post->institute->profile_photo ?? 'images/default-logo.png')) }}" alt="Profile Picture">
                    <div>
                        <div class="post-author">{{ $post->institute->institute_name }}</div>
                        <div class="post-timestamp">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <!-- Content -->
                <div class="post-content">
                    <h3>{{ $post->title }}</h3>
                    <p>{!! nl2br(e($post->small_description)) !!}</p>
                </div>

                <!-- Footer -->
        <div class="post-footer">
            <button class="like-button" onclick="toggleLike({{ $post->id }})">
                <span class="like-icon">👍</span> 
                {{ session()->get("liked_post_{$post->id}", false) ? 'Liked' : 'Like' }}
            </button>
            {{-- <button class="about-the-course">See More About This Course</button> --}}
            <div class="post-timestamp">{{ $post->likes_count ?? 0 }} Likes</div>
        </div>
            </div>
        </div>
    @empty
        <p>No posts available at the moment.</p>
    @endforelse
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



</script>


    









