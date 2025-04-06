@extends('landlord.shell')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>My Rooms</h1>
                @if ($isVerifiedLandlord)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoomModal">
                        Create Room
                    </button>
                @else
                    <button class="btn btn-secondary" disabled>
                        Create Room
                    </button>
                @endif
            </div>
            <div class="col-md-12">
                @if (!$isVerifiedLandlord)
                    <div class="alert alert-warning">
                        Your account is not verified yet. Please wait for the admin to verify your account.
                    </div>
                @endif
            </div>

            <div class="col-md-12">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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