<div class="card shadow-sm">
    @if(is_array($room->picture_urls) && count($room->picture_urls) > 0)
        <div id="roomCarousel{{ $room->id }}" class="carousel slide mb-3" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($room->picture_urls as $index => $url)
                        @php
                            if (Str::startsWith($url, 'http://localhost')) {
                                $imageSrc = str_replace('http://localhost', 'http://localhost:' . env('APP_PORT', '8000'), $url);
                            } else {
                                $imageSrc = Str::startsWith($url, ['http://', 'https://']) ? $url : asset($url);
                            }
                        @endphp
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ $imageSrc }}" class="d-block w-100 img-fluid rounded" alt="Room Image"
                                onerror="this.onerror=null;this.src='{{ asset('images/jpg/room-placeholder.png') }}';">
                        </div>
                @endforeach
            </div>
            @if(count($room->picture_urls) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel{{ $room->id }}"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel{{ $room->id }}"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    @else
        <img src="{{ asset('images/jpg/room-placeholder.png') }}" class="img-fluid rounded" alt="Default Room Image">
    @endif

    <div class="card-body pt-0">
        <h5 class="card-title">{{ $room->title }}</h5>
        @php
            $descArray = is_array($room->description) ? $room->description : json_decode($room->description, true);
            $theSpaceText = $descArray['The space'] ?? null;
        @endphp

        @if ($theSpaceText)
            <p class="card-text text-muted">{{ Str::limit($theSpaceText, 150, '...') }}</p>
        @endif
        <p><strong>Price:</strong> ₱{{ number_format($room->price, 2) }}</p>
        <p><strong>Location:</strong> {{ $room->location }}</p>
        <span class="badge {{ $room->status == 'Available' ? 'bg-success' : 'bg-danger' }}">
            {{ $room->status }}
        </span>
        <div class="mt-3">
            <a href="{{ route('landlord.rooms.edit', ['room' => $room]) }}" class="btn btn-sm btn-warning">
                Edit
            </a>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                data-bs-target="#deleteRoomModal{{ $room->id }}">
                Delete
            </button>
        </div>
    </div>
</div>
<!-- Delete Room Modal -->
@include('landlord.room._ui.modal-delete', ['rooms' => $rooms])