@extends('landlord.shell')

@section('content')
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
                <textarea class="form-control" id="description" name="description"
                    rows="3">{{ old('description', $room->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
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

            <button type="submit" class="btn btn-primary w-100">Update Room</button>
        </form>
    </div>

    @push('scripts')
        <script>
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