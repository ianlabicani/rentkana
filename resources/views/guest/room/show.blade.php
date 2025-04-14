@extends('guest.shell')

@section('guest-content')
    <div class="container my-5">
        <a href="{{ route('guest.rooms.index') }}" class="btn btn-secondary mb-3">← Back to Room Listings</a>

        <div class="row">
            <div class="col-md-7">
                <div id="roomCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $placeholder = asset('images/jpg/room-placeholder.png');
                            $images = is_array($room->picture_urls) && count($room->picture_urls) ? $room->picture_urls : [$placeholder];
                            foreach ($images as $index => $image) {
                                if (Str::startsWith($image, 'http://localhost')) {
                                    $images[$index] = str_replace('http://localhost', 'http://localhost:' . env('APP_PORT', '8000'), $image);
                                } else {
                                    $images[$index] = Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image);
                                }
                            }

                        @endphp

                        @foreach ($images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $image }}" class="d-block w-100 rounded"
                                    onerror="this.onerror=null;this.src='{{ $placeholder }}';"
                                    style="max-height: 400px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    @if (count($images) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            </div>

            <div class="col-md-5">
                <h2>{{ $room->title }}</h2>
                <p class="text-muted mb-1">₱{{ number_format($room->price, 2) }}</p>
                <p><strong>Location:</strong> {{ $room->location }}</p>
                <p><strong>Status:</strong> {{ $room->status }}</p>
                <hr>
                <p>{{ $room->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>
@endsection