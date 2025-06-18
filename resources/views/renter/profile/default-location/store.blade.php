<!-- Add New Default Location Form -->
<form method="POST" action="{{ route('renter.default-location.store') }}">
    @csrf
    <h6 class="mb-3 text-secondary">Add New Location</h6>

    <div class="mb-2">
        <label class="form-label">Name *</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-2">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control">
    </div>

    <div class="row mb-2">
        <div class="col">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control">
        </div>
        <div class="col">
            <label class="form-label">State</label>
            <input type="text" name="state" class="form-control">
        </div>
    </div>

    <div class="row mb-2">
        <div class="col">
            <label class="form-label">Postal Code</label>
            <input type="text" name="postal_code" class="form-control">
        </div>
        <div class="col">
            <label class="form-label">Country</label>
            <input type="text" name="country" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Pick Location on Map</label>
        <div id="locationMap" style="height: 300px; width: 100%;"></div>
    </div>
    <div class="row mb-2">
        <div class="col">
            <label class="form-label">Latitude</label>
            <input type="text" name="lat" id="lat" class="form-control" readonly required>
        </div>
        <div class="col">
            <label class="form-label">Longitude</label>
            <input type="text" name="lng" id="lng" class="form-control" readonly required>
        </div>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Add Location</button>
    </div>
</form>

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var map = L.map('locationMap').setView([17.6161786, 121.7281484], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);
            var marker;
            map.on('click', function (e) {
                var lat = e.latlng.lat.toFixed(8);
                var lng = e.latlng.lng.toFixed(8);
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
                if (marker) { map.removeLayer(marker); }
                marker = L.marker([lat, lng]).addTo(map);
            });
        });
    </script>
@endpush
