@extends('shell')

@section('content')
    @include('_ui.hero-section')
    <div class="container my-5">
        <h3 class="mb-3">Room Locations Map</h3>
        <div id="roomsMap" style="height: 500px; width: 100%;"></div>
    </div>

    @include('_ui.discover-section')

    @include('_ui.faq')

    @include('_ui.featured-rooms')

    @include('_ui.landlord-section')

    @include('_ui.careers-section')

@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Use $allRooms from backend
            const rooms = @json($allRooms);
            if (!rooms.length) return;
            var map = L.map('roomsMap').setView([rooms[0].lat, rooms[0].lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);
            rooms.forEach(room => {
                if (room.lat && room.lng) {
                    L.marker([room.lat, room.lng]).addTo(map)
                        .bindPopup('<b>' + room.title + '</b><br>' + room.location);
                }
            });
        });
    </script>
@endpush