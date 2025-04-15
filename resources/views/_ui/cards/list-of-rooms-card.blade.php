@forelse($featuredRooms as $room)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm border-0 room-card">
            <div class="position-relative">
                @php
                    $placeholder = asset('images/jpg/room-placeholder.png');
                    $firstImage =
                        is_array($room->picture_urls) && count($room->picture_urls) > 0
                        ? $room->picture_urls[0]
                        : $placeholder;

                    if (Str::startsWith($firstImage, 'http://localhost')) {
                        $firstImage = str_replace(
                            'http://localhost',
                            'http://localhost:' . env('APP_PORT', '8000'),
                            $firstImage,
                        );
                    } elseif (!Str::startsWith($firstImage, ['http://', 'https://'])) {
                        $firstImage = asset($firstImage);
                    }
                @endphp

                <img src="{{ $firstImage }}" class="card-img-top" alt="{{ $room->title }}"
                    style="height: 200px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                <div class="position-absolute top-0 end-0 p-2">
                    <span class="badge bg-success">{{ $room->status }}</span>
                </div>
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $room->title }}</h5>
                <p class="card-text text-muted mb-2">
                    <i class="fas fa-map-marker-alt me-1"></i> {{ $room->location }}
                </p>
                @php
                    $descArray = is_array($room->description) ? $room->description : json_decode($room->description, true);
                    $aboutThisPlacetext = $descArray['About this place'] ?? null;
                @endphp

                @if ($aboutThisPlacetext)
                    <p class="card-text mb-3">
                        {{ Str::limit($room->aboutThisPlacetext, 100) }}
                    </p>
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">₱{{ number_format($room->price, 2) }}/month</h5>
                    <a href="{{ route('guest.rooms.show', $room->id)}}" class="btn btn-sm btn-outline-primary">
                        View Details
                    </a>
                </div>
            </div>

            <div class="card-footer bg-transparent border-top-0">
                <small class="text-muted">
                    <i class="far fa-clock me-1"></i> Listed {{ $room->created_at->diffForHumans() }}
                </small>
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            No rooms available at the moment. Check back soon!
        </div>

        <div class="mt-4">
            <p>Are you a landlord with rooms to rent?</p>
            <a href="{{ route('register') }}?role=landlord" class="btn btn-primary">Register & List Your Rooms</a>
        </div>
    </div>
@endforelse