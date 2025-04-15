@extends('landlord.shell')

@section('landlord-content')

    <div class="container mt-5">
        <h5>Create Room</h5>
        <form action="{{ route('landlord.rooms.store') }}" method="POST" enctype="multipart/form-data">
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

            <!-- Room Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
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
            <button type="submit" class="btn btn-success w-100">Save Room</button>
        </form>
    </div>
    @push('scripts')
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
                    entry.innerHTML = `
                                                                                                    <div class="col-5">
                                                                                                        <input type="text" class="form-control" placeholder="Key" name="description_keys[]">
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <input type="text" class="form-control" placeholder="Value" name="description_values[]">
                                                                                                    </div>
                                                                                                    <div class="col-1 d-grid">
                                                                                                        <button type="button" class="btn btn-danger remove-description">×</button>
                                                                                                    </div>
                                                                                                `;
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