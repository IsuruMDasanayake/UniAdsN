<d class="content-container">
    
    <!-- Browse by Discipline Section -->
    <div class="section">
        <h3 class="section-title">Explore a Wide Range of Disciplines to Find Your Perfect Course</h3>

        
        
            <!-- Iterate through grouped categories -->
            @foreach ($categories as $mainCategory => $items)
                <div class="filter-category">
                    <h3 class="filter-title">{{ $mainCategory }}</h3>
                    <div class="grid-container">
                        @foreach ($items as $category)
                            <a href="{{ route('posts.filter', ['filterType' => $mainCategory, 'filterValue' => $category->name])}}" class="grid-card">
                                <i class="{{ $category->icon }}"></i>
                                <p>{{ $category->name }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>   
    </div>
</div>
