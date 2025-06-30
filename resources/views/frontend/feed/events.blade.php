<div class="upcoming-events-card">
    <div class="card-header">
        <h2>Upcoming Events</h2>
        {{-- <a href="#">See all</a> --}}
    </div>
    <div class="event-content">
        <!-- Each event will be a separate card -->
        
        @if($events->isEmpty())
    <p>No upcoming events found.</p>
@else
    @foreach($events as $event)
    <div class="event">
        <div class="event-image-wrapper">
            <!-- Display Event Image -->
            <img class="event-image" src="{{ asset('storage/' . $event->event_image) }}" alt="{{ $event->event_title }}">
        </div>
        <div class="event-details">
            <!-- Display Event Date -->
            <div class="event-date">
                <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M') }}</span>
                {{ $event->institute->institute_name }}
            </div>

            <!-- Display Event Title -->
            <p class="event-title">{{ $event->event_title }}</p>

            <!-- Display Event Location -->
            <p class="event-location">{{ $event->sub_location }}</p>

            <!-- Event Actions -->
            {{-- <div class="event-actions">
                <button class="btn-interested">Interested</button>
                <button class="btn-decline">Decline</button>
            </div> --}}
        </div>
    </div>
    @endforeach
@endif

        <!-- Add more events dynamically here -->
    </div>
</div>
