@foreach($posts as $post)
<div class="post-card">
    <div class="post-image-wrapper">
        <img class="post-image" src="{{ asset('storage/' . $post->image) }}" alt="Post Image">
    </div>

    <div class="post-details">
        <div class="post-header">
            <a href="{{ url('/institutions/' . $post->institute->id . '/profile') }}">
                <img class="profile-picture" src="{{ asset('storage/' . ($post->institute->profile_photo ?? 'images/profile.png')) }}" alt="Profile Picture">
            </a>
            <div>
                <a href="{{ url('/institutions/' . $post->institute->id . '/profile') }}" class="institute-name-link">
                    <div class="post-author">{{ $post->institute->institute_name }}</div>
                </a>
                <div class="post-timestamp">{{ $post->created_at->diffForHumans() }}</div>
            </div>
        </div>

        <div class="post-content">
            <h3>{{ $post->title }}</h3>
            <p>{!! nl2br(e($post->small_description)) !!}</p>
        </div>

        <div class="post-footer">
            <button class="like-button" onclick="toggleLike({{ $post->id }})">
                <span class="like-icon"></span>
                {{ session()->get("liked_post_{$post->id}", false) ? 'Liked' : 'Like This' }}
            </button>
            <br>
            @php
                $escapedDescription = str_replace(["\r", "\n"], [' ', '\n'], strip_tags($post->description));
            @endphp
            <button class="about-the-course"
              onclick="openPostModal(
                '{{ asset('storage/' . $post->image) }}',
                '{{ e($post->title) }}',
                `{{ str_replace(["\r", "\n"], ["", "\\n"], e($post->description)) }}`,
                '{{ $post->institute->id }}',
                '{{ $post->institute->contact_number }}'
              )">
              See More
            </button>
            <div class="post-timestamp">{{ $post->likes_count ?? 0 }} Likes</div>
        </div>
    </div>
</div>
@endforeach
