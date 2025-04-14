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
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <!-- Room Price -->
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
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

    <script>
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Find the card that contains the image using parentElement
                        const cardImage = input.closest('.card').querySelector('.card-img-top');
                        cardImage.src = e.target.result; // Set the preview image in the card
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

    </script>

@endsection