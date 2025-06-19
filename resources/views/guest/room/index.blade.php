@extends('guest.shell')

@section('title', 'Room Listings')

@section('guest-content')
    <div class="container my-5">
        <h2 class="mb-4">Available Rooms</h2>
        <div class="row">
            <div class="col-lg-9 order-2 order-lg-1">
                <div class="mb-4">
                    <h5>Room Locations Map</h5>
                    <button class="btn btn-outline-primary mb-2" id="locateMeBtn" type="button">
                        <i class="bi bi-geo-alt"></i> Use My Location
                    </button>
                    @auth
                        @if($defaultLocation)
                            <button class="btn btn-outline-success mb-2 ms-2" id="defaultLocationBtn" type="button">
                                <i class="bi bi-pin-map"></i> Use My Default Location
                            </button>
                        @endif
                    @endauth
                    <div id="roomsMap" style="height: 600px; width: 100%;"></div>
                </div>
            </div>
            <div class="col-lg-3 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="card shadow-sm sticky-top" style="top: 90px;">
                    <div class="card-header bg-primary text-white">
                        <strong>Rooms within 1km</strong>
                    </div>
                    <ul class="list-group list-group-flush" id="nearbyRoomsList">
                        <li class="list-group-item text-muted">Enable location to see nearby rooms.</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @forelse ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @php
                            $placeholder = asset('images/jpg/room-placeholder.png');
                            $pictureUrls = is_array($room->picture_urls) ? $room->picture_urls : [];
                            $firstImage = count($pictureUrls) > 0 ? $pictureUrls[0] : $placeholder;
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

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        function haversineDistance(lat1, lng1, lat2, lng2) {
            function toRad(x) { return x * Math.PI / 180; }
            var R = 6371; // km
            var dLat = toRad(lat2 - lat1);
            var dLng = toRad(lng2 - lng1);
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }
        document.addEventListener('DOMContentLoaded', function () {
            const rooms = @json($rooms->whereNotNull('lat')->whereNotNull('lng')->values());
            if (!rooms.length) return;
            var map = L.map('roomsMap').setView([rooms[0].lat, rooms[0].lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            var userMarker = null;
            var userCircle = null;
            var hasCenteredOnUser = false;
            function addMarkers(userLoc, centerMap = false, isDefaultLocation = false) {
                if (userMarker) { map.removeLayer(userMarker); userMarker = null; }
                if (userCircle) { map.removeLayer(userCircle); userCircle = null; }
                if (userLoc) {
                    userMarker = L.marker([userLoc.lat, userLoc.lng], {
                        icon: L.icon({
                            iconUrl: 'https://cdn-icons-png.flaticon.com/512/64/64113.png',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                            popupAnchor: [0, -32]
                        })
                    }).addTo(map).bindPopup(isDefaultLocation ? '<b>Your Default Location</b>' : '<b>Your Location</b>').openPopup();
                    userCircle = L.circle([userLoc.lat, userLoc.lng], {
                        color: isDefaultLocation ? '#198754' : '#007bff',
                        fillColor: isDefaultLocation ? '#198754' : '#007bff',
                        fillOpacity: 0.1,
                        radius: 1000 // 1km in meters
                    }).addTo(map);
                    if (centerMap) {
                        map.setView([userLoc.lat, userLoc.lng], 13);
                    }
                }
                rooms.forEach(room => {
                    if (room.lat && room.lng) {
                        let popup = '<b>' + room.title + '</b><br>' + room.location;
                        if (userLoc) {
                            const dist = haversineDistance(userLoc.lat, userLoc.lng, room.lat, room.lng);
                            popup += '<br><span class="text-primary">' + dist.toFixed(2) + ' km away</span>';
                        }
                        // Add link to room details
                        popup += '<br><a href="' + roomDetailsUrl(room.id) + '" class="btn btn-sm btn-outline-primary mt-2">View Details</a>';
                        L.marker([room.lat, room.lng]).addTo(map).bindPopup(popup);
                    }
                });
            }
            function updateNearbyRooms(userLoc) {
                const rooms = @json($rooms->whereNotNull('lat')->whereNotNull('lng')->values());
                const list = document.getElementById('nearbyRoomsList');
                list.innerHTML = '';
                if (!userLoc) {
                    list.innerHTML = '<li class="list-group-item text-muted">Enable location to see nearby rooms.</li>';
                    return;
                }
                let found = false;
                rooms.forEach(room => {
                    if (room.lat && room.lng) {
                        const dist = haversineDistance(userLoc.lat, userLoc.lng, room.lat, room.lng);
                        if (dist <= 1) {
                            found = true;
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.innerHTML = `<b>${room.title}</b><br><span class='text-muted'>${room.location}</span><br><span class='badge bg-primary'>${dist.toFixed(2)} km</span> <a href="${roomDetailsUrl(room.id)}" class="btn btn-sm btn-link">View</a>`;
                            list.appendChild(li);
                        }
                    }
                });
                if (!found) {
                    list.innerHTML = '<li class="list-group-item text-muted">No rooms within 1km.</li>';
                }
            }
            function roomDetailsUrl(id) {
                return "{{ url('rooms') }}/" + id;
            }
            document.getElementById('locateMeBtn').addEventListener('click', function () {
                if (window._userLocation) {
                    map.setView([window._userLocation.lat, window._userLocation.lng], 13);
                    addMarkers(window._userLocation, false, false);
                    updateNearbyRooms(window._userLocation);
                } else {
                    alert('Location not available. Please allow location access.');
                }
            });

            const defaultLocationBtn = document.getElementById('defaultLocationBtn');
            if (defaultLocationBtn) {
                defaultLocationBtn.addEventListener('click', function () {
                    const defaultLocation = @json($defaultLocation ?? null);
                    if (defaultLocation && defaultLocation.lat && defaultLocation.lng) {
                        const loc = { lat: defaultLocation.lat, lng: defaultLocation.lng };
                        map.setView([loc.lat, loc.lng], 13);
                        addMarkers(loc, false, true);
                        updateNearbyRooms(loc);
                    }
                });
            }

            if (window._userLocation) {
                addMarkers(window._userLocation, true, false);
                hasCenteredOnUser = true;
                updateNearbyRooms(window._userLocation);
            }
            document.addEventListener('user-location-available', function (e) {
                addMarkers(e.detail, !hasCenteredOnUser, false);
                if (!hasCenteredOnUser) hasCenteredOnUser = true;
                updateNearbyRooms(e.detail);
            });
            document.addEventListener('user-location-unavailable', function () {
                addMarkers(null, false);
                updateNearbyRooms(null);
            });
        });
    </script>
@endpush