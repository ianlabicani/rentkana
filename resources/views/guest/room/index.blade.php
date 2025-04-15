@extends('guest.shell')

@section('guest-content')
    <div class="container my-5">
        <h2 class="mb-4">Available Rooms</h2>

        <div class="row">
            @forelse ($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @php
                                $placeholder = asset('images/jpg/room-placeholder.png');
                                $pictureUrls = is_array($room->picture_urls) ? $room->picture_urls : [];

                                $firstImage = count($pictureUrls) > 0 ? $pictureUrls[0] : $placeholder;

                                // Adjust localhost port for dev env
                                if (Str::startsWith($firstImage, 'http://localhost')) {
                                    $firstImage = str_replace('http://localhost', 'http://localhost:' . env('APP_PORT', '8000'), $firstImage);
                                } else {
                                    $firstImage = Str::startsWith($firstImage, ['http://', 'https://']) ? $firstImage : asset($firstImage);
                                }
                            @endphp

                            <div class="position-relative">
                                <img src="{{ $firstImage }}" class="card-img-top" alt="{{ $room->title }}"
                                    onerror="this.onerror=null;this.src='{{ $placeholder }}';"
                                    style="height: 200px; object-fit: cover;">

                                @if(count($pictureUrls) > 1)
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-dark bg-opacity-75">
                                        +{{ count($pictureUrls) - 1 }} more
                                    </span>
                                @endif
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ $room->title }}</h5>
                                <p class="card-text text-muted mb-1">₱{{ number_format($room->price, 2) }}</p>
                                <p class="card-text">
                                    {{ Str::limit($room->location, 60) }}
                                </p>
                                @php
                                    $descArray = is_array($room->description) ? $room->description : json_decode($room->description, true);
                                    $theSpaceText = $descArray['About this place'] ?? null;
                                @endphp

                                @if ($theSpaceText)
                                    <p class="card-text text-muted">{{ Str::limit($theSpaceText, 150, '...') }}</p>
                                @endif
                                <p class="card-text"><small>Status: {{ $room->status }}</small></p>
                            </div>

                            <div class="card-footer bg-transparent border-0">
                                <a href="{{ route('guest.rooms.show', $room->id) }}" class="btn btn-outline-primary w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No rooms available at the moment.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection