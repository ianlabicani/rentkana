@extends('landlord.shell')

@section('landlord-content')
    <div class="container my-4">
        <h2>Edit Room</h2>

        <form action="{{ route('landlord.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $room->title) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>

                <div id="descriptionFields">
                    @php
                        // Use old inputs if available (for validation errors)
                        $keys = old('description_keys', []);
                        $values = old('description_values', []);
                        $description = [];

                        if (!empty($keys) && !empty($values)) {
                            foreach ($keys as $index => $key) {
                                $description[$key] = $values[$index] ?? '';
                            }
                        } else {
                            $description = is_array($room->description) ? $room->description : json_decode($room->description, true) ?? [];
                        }

                        $defaultDescription = [
                            'The space' => 'The space...',
                            'Guest access' => 'Guest access...',
                            'During your stay' => 'During your stay...',
                            'About this place' => 'About this place...',
                        ];

                        // Only add missing default keys
                        foreach ($defaultDescription as $key => $defaultValue) {
                            if (!array_key_exists($key, $description)) {
                                $description[$key] = $defaultValue;
                            }
                        }
                    @endphp

                    @foreach ($description as $key => $value)
                        <div class="d-flex mb-3 description-item">
                            <input type="text" class="form-control me-2 description-key" name="description_keys[]"
                                value="{{ $key }}" placeholder="Section title" required>
                            <input type="text" class="form-control me-2 description-value" name="description_values[]"
                                value="{{ $value }}" placeholder="Description content" required>
                            @if (!in_array($key, array_keys($defaultDescription)))
                                <button type="button" class="btn btn-danger remove-description">Remove</button>
                            @endif
                        </div>
                    @endforeach
                </div>


                <button type="button" id="addDescription" class="btn btn-secondary mt-2">Add another description
                    section</button>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price (per month)</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                    value="{{ old('price', $room->price) }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="{{ old('location', $room->location) }}" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Available" {{ $room->status === 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Occupied" {{ $room->status === 'Occupied' ? 'selected' : '' }}>Occupied</option>
                </select>
            </div>

            <div class="alert alert-info mb-3" role="alert">
                Note: Each image must not exceed 5 MB in size.
            </div>

            <div class="mb-3">
                <label class="form-label">Replace Room Images</label>

                @php
                    $maxImages = 4;
                    $currentImages = is_array($room->picture_urls) ? $room->picture_urls : [];
                    $placeholder = asset('images/jpg/room-placeholder.png');
                @endphp

                <div class="row">
                    @for ($i = 0; $i < $maxImages; $i++)
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100 shadow-sm">
                                            <div class="card-body text-center">
                                                @php
                                                    $url = $currentImages[$i] ?? null;
                                                    if ($url) {
                                                        if (Str::startsWith($url, 'http://localhost')) {
                                                            $imageSrc = str_replace('http://localhost', 'http://localhost:' . env('APP_PORT', '8000'), $url);
                                                        } else {
                                                            $imageSrc = Str::startsWith($url, ['http://', 'https://']) ? $url : asset($url);
                                                        }
                                                    } else {
                                                        $imageSrc = $placeholder;
                                                    }
                                                @endphp

                                                <img src="{{ $imageSrc }}" class="img-fluid rounded mb-3 preview-img" alt="Room Image"
                                                    data-index="{{ $i }}" onerror="this.onerror=null;this.src='{{ $placeholder }}';"
                                                    style="max-height: 150px;">

                                                <input type="file" name="photo{{ $i + 1 }}" class="form-control mb-2 image-input"
                                                    data-index="{{ $i }}" accept="image/*">
                                                <small class="text-muted">Replace image {{ $i + 1 }}</small>
                                            </div>
                                        </div>
                                    </div>
                    @endfor
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100" onclick="this.disabled=true; this.form.submit();">Update
                Room</button>
        </form>
    </div>

    @push('scripts')
        <script>
            // Add new description input field
            document.getElementById('addDescription').addEventListener('click', function () {
                const newDescription = document.createElement('div');
                newDescription.classList.add('d-flex', 'mb-3', 'description-item');

                newDescription.innerHTML = `
                                                                                                    <input type="text" class="form-control me-2 description-key" name="description_keys[]" placeholder="Section title" required>
                                                                                                    <input type="text" class="form-control me-2 description-value" name="description_values[]" placeholder="Description content" required>
                                                                                                    <button type="button" class="btn btn-danger remove-description">Remove</button>
                                                                                                `;

                document.getElementById('descriptionFields').appendChild(newDescription);
            });

            // Remove description section
            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-description')) {
                    e.target.closest('.description-item').remove();
                }
            });

            // Image input preview
            document.querySelectorAll('.image-input').forEach(input => {
                input.addEventListener('change', function (e) {
                    const index = this.dataset.index;
                    const previewImg = document.querySelector(`.preview-img[data-index='${index}']`);

                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewImg.src = e.target.result;
                        }
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });
        </script>
    @endpush
@endsection