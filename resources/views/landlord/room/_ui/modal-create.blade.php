<div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="createRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRoomModalLabel">Create Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('landlord.rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Available">Available</option>
                            <option value="Occupied">Occupied</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Room Images</label>
                        <div class="row">
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="col-md-3 mb-3">
                                    <div class="card" style="cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#uploadModal{{ $i }}">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Image {{ $i }}</h5>
                                            <img src="{{ asset('images/jpg/room-placeholder.png') }}"
                                                class="card-img-top img-fluid" alt="Room Image">
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal for image upload -->
                                <div class="modal fade" id="uploadModal{{ $i }}" tabindex="-1"
                                    aria-labelledby="uploadModalLabel{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="uploadModalLabel{{ $i }}">Upload Image {{ $i }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="file" class="form-control" id="photo{{ $i }}"
                                                    name="photo{{ $i }}" accept="image/*">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    onclick="saveImage({{ $i }})">Save Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>


                    <button type="submit" class="btn btn-success w-100">Save Room</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function saveImage(imageIndex) {
        const fileInput = document.getElementById(`photo${imageIndex}`);
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                const cardImage = document.querySelector(`#uploadModal${imageIndex} .card-img-top`);
                cardImage.src = event.target.result; // Set the image preview in the card
                $('#uploadModal' + imageIndex).modal('hide'); // Close the modal after saving
            };
            reader.readAsDataURL(file); // Read the file as a data URL for preview
        } else {
            alert("Please select an image.");
        }
    }

</script>