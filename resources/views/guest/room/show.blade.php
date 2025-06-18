@extends('guest.shell')

@section('title', 'Room Details')

@section('guest-content')
    <div class="container my-5">
        <a href="{{ route('guest.rooms.index') }}" class="btn btn-secondary mb-3">← Back to Room Listings</a>

        <div class="row">
            <div class="col-md-7">
                <div id="roomCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $placeholder = asset('images/jpg/room-placeholder.png');
                            $images = is_array($room->picture_urls) ? $room->picture_urls : [];

                            if (count($images) === 0) {
                                $images[] = $placeholder;
                            }

                            foreach ($images as $index => $img) {
                                if (Str::startsWith($img, 'http://localhost')) {
                                    $images[$index] = str_replace('http://localhost', 'http://localhost:' . env('APP_PORT', '8000'), $img);
                                } else {
                                    $images[$index] = Str::startsWith($img, ['http://', 'https://']) ? $img : asset($img);
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

                @if($room->lat && $room->lng)
                    <div class="mb-4">
                        <h5>Room Location</h5>
                        <div id="roomMap" style="height: 400px; width: 100%;"></div>
                    </div>
                @endif
            </div>

            <div class="col-md-5">
                <h2>{{ $room->title }}</h2>
                <p class="text-muted mb-1">₱{{ number_format($room->price, 2) }}
                    <span class="text-muted mb-1"><em>(Per head, per month)</em></span>
                </p>
                <p><strong>Location:</strong> {{ $room->location }}</p>
                <p><strong>Status:</strong> {{ $room->status }}</p>
                <hr>

                <div>
                    @php
                        $description = is_array($room->description)
                            ? $room->description
                            : (is_string($room->description) && Str::startsWith($room->description, '{')
                                ? json_decode($room->description, true)
                                : ['Details' => $room->description]);

                        if (!is_array($description)) {
                            $description = ['Details' => 'No description provided.'];
                        }
                    @endphp

                    @foreach ($description as $key => $value)
                        <p><strong>{{ ucfirst($key) }}:</strong> {{ $value ?: 'N/A' }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if($room->lat && $room->lng)
                var map = L.map('roomMap').setView([{{ $room->lat }}, {{ $room->lng }}], 16);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);
                L.marker([{{ $room->lat }}, {{ $room->lng }}]).addTo(map)
                    .bindPopup('<b>{{ addslashes($room->title) }}</b><br>{{ addslashes($room->location) }}').openPopup();
            @endif
                });
    </script>
@endpush