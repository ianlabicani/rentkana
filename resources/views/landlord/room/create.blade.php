@extends('landlord.shell')

@section('title', 'Create Room')

@section('landlord-content')

                <div class="container mt-5">
                    <h5>Create Room</h5>
                    <form action="{{ route('landlord.rooms.store') }}" method="POST" enctype="multipart/form-data" id="roomForm">
                        @csrf

                        <!-- Room Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Room Description -->
                        <div class="mb-3">
                            <label class="form-label">Room Description</label>
                            @php
    $defaultDescription = [
        'The space' => 'The space is ideal for...',
        'Guest access' => 'Guests will have access to...',
        'During your stay' => 'During your stay, we are available to...',
        'About this place' => 'This place is known for...',
    ];
                            @endphp


                            <div id="description-fields">
                                @foreach ($defaultDescription as $key => $value)
                                    <div class="row g-2 mb-2 description-entry">
                                        <div class="col-5">
                                            <input type="text" class="form-control" placeholder="Key" name="description_keys[]"
                                                value="{{ $key }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" placeholder="Value" name="description_values[]"
                                                value="{{ $value }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-description">+ Add Field</button>

                            <input type="hidden" name="description" id="description-json">
                        </div>

                        <!-- Room Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (per head per month)</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>


                        <!-- Room Latitude and Longitude (via Map) -->
                        <div class="mb-3">
                            <label class="form-label">Room Location (Click on the map)</label>
                            <div id="map" style="height: 500px; width: 100%;"></div>
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude" readonly required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="lng" name="lng" placeholder="Longitude" readonly required>
                                </div>
                            </div>
                        </div>

                        <!-- Room Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Available">Available</option>
                                <option value="Occupied">Occupied</option>
                            </select>
                        </div>

                        <!-- Room Images Section -->
                        <div class="alert alert-info mb-3" role="alert">
                            Note: Each image must not exceed 5 MB in size.
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Room Images</label>
                            <div class="row">
                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Image {{ $i }}</h5>
                                                <img src="{{ asset('images/jpg/room-placeholder.png') }}" class="card-img-top img-fluid"
                                                    alt="Room Image">
                                                <input type="file" class="form-control mt-2" id="photo{{ $i }}" name="photo{{ $i }}"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Save Button -->
                        <button type="submit" class="btn btn-success w-100" id="submitBtn">
                            <span id="btnText">Save Room</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
                @push('scripts')
                            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var map = L.map('map').setView([17.6161786, 121.7281484], 10);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap contributors'
                            }).addTo(map);
                            var marker;
                            map.on('click', function(e) {
                                var lat = e.latlng.lat.toFixed(7);
                                var lng = e.latlng.lng.toFixed(7);
                                document.getElementById('lat').value = lat;
                                document.getElementById('lng').value = lng;
                                if (marker) { map.removeLayer(marker); }
                                marker = L.marker([lat, lng]).addTo(map);
                            });
                        });
                    </script>

                            <!-- Save Button -->
                            <script>
                                document.getElementById('roomForm').addEventListener('submit', function () {
                                    const submitBtn = document.getElementById('submitBtn');
                                    submitBtn.disabled = true;

                                    document.getElementById('btnText').textContent = 'Saving...';
                                    document.getElementById('btnSpinner').classList.remove('d-none');
                                });
                            </script>


                            <script>
                                const fileInputs = document.querySelectorAll('input[type="file"]');
                                fileInputs.forEach(input => {
                                    input.addEventListener('change', function () {
                                        const file = this.files[0];
                                        if (file) {
                                            const reader = new FileReader();
                                            reader.onload = function (e) {
                                                const cardImage = input.closest('.card').querySelector('.card-img-top');
                                                cardImage.src = e.target.result;
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    });
                                });

                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const addBtn = document.getElementById('add-description');
                                    const fieldsContainer = document.getElementById('description-fields');
                                    const hiddenInput = document.getElementById('description-json');

                                    function createField() {
                                        const entry = document.createElement('div');
                                        entry.className = 'row g-2 mb-2 description-entry';
                                        const template = '
                                            < div class="col-5" >
                                                < input type = "text" class="form-control" placeholder = "Key" name = "description_keys[]" >
                                            </div >
                                            <div class="col-6">
                                                <input type="text" class="form-control" placeholder="Value" name="description_values[]">
                                            </div>
                                            <div class="col-1 d-grid">
                                                <button type="button" class="btn btn-danger remove-description">×</button>
                                            </div>'
                                        entry.innerHTML = template;
                                        fieldsContainer.appendChild(entry);
                                    }

                                    addBtn.addEventListener('click', createField);

                                    fieldsContainer.addEventListener('click', function (e) {
                                        if (e.target.classList.contains('remove-description')) {
                                            e.target.closest('.description-entry').remove();
                                        }
                                    });

                                    // Convert to JSON on form submit
                                    document.querySelector('form').addEventListener('submit', function () {
                                        const keys = Array.from(document.querySelectorAll('input[name="description_keys[]"]')).map(i => i.value.trim());
                                        const values = Array.from(document.querySelectorAll('input[name="description_values[]"]')).map(i => i.value.trim());
                                        const json = {};

                                        keys.forEach((key, index) => {
                                            if (key) json[key] = values[index] || '';
                                        });

                                        hiddenInput.value = JSON.stringify(json);
                                    });
                                });
                            </script>
                @endpush


@endsection
