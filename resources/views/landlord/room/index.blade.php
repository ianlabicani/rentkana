@extends('landlord.shell')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>My Rooms</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                    Create Room
                </button>
            </div>

            <div class="row mt-4">
                @foreach ($rooms as $room)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ $room->image ?? asset('images/jpg/room-placeholder.png') }}"
                                class="card-img-top img-fluid" alt="Room Image">
                            <div class="card-body pt-0">
                                <h5 class="card-title">{{ $room->title }}</h5>
                                <p class="card-text text-muted">{{ $room->description }}</p>
                                <p><strong>Price:</strong> ₱{{ number_format($room->price, 2) }}</p>
                                <p><strong>Location:</strong> {{ $room->location }}</p>
                                <span class="badge {{ $room->status == 'Available' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $room->status }}
                                </span>
                                <div class="mt-3">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editRoomModal{{ $room->id }}">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteRoomModal{{ $room->id }}">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Room Modal -->
                    @include('landlord.room._ui.modal-edit', ['rooms' => $rooms])
                    <!-- Delete Room Modal -->
                    @include('landlord.room._ui.modal-delete', ['rooms' => $rooms])
                @endforeach
            </div>
        </div>
    </div>

    <!-- Create Room Modal -->
    @include('landlord.room._ui.modal-create')
@endsection