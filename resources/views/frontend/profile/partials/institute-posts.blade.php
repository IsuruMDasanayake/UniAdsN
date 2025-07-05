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
                     >
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