@extends('landlord.shell')

@section('landlord-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>My Rooms</h1>
                @if ($isVerifiedLandlord)
                    <a href="{{ route('landlord.rooms.create') }}" class="btn btn-primary">
                        Create Room
                    </a>
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
                        @include('landlord.room._ui.room-card', ['room' => $room])
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection