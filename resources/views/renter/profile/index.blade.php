@extends('renter.shell')

@section('title', 'Profile')

@section('renter-content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>Profile</h1>
            </div>

            <div class="col-md-12 mt-3">

                <!-- Profile Info -->
                <div class="d-flex flex-column align-items-center">
                    <div class="profile-avatar mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=007bff&color=fff&size=128"
                            alt="Avatar" class="rounded-circle shadow"
                            style="width: 128px; height: 128px; object-fit: cover;">
                    </div>
                    <h2 class="fw-bold mb-1">{{ $user->name }}</h2>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                </div>

                <!-- Profile Details -->
                <div class="card mt-3 mx-auto shadow-sm" style="max-width: 500px;">
                    <div class="card-body">
                        <h5 class="card-title mb-3 text-primary">Profile Details</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                            <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</li>
                            <li class="list-group-item"><strong>Registered:</strong>
                                {{ $user->created_at->format('F d, Y') }}</li>
                            <li class="list-group-item"><strong>Status:</strong>
                                <span class="badge bg-success">{{ $user->status ?? 'Active' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Default Locations -->
                <div class="card mt-4 mx-auto shadow-sm" style="max-width: 800px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Default Locations</h5>

                        @if ($user->defaultLocations->isEmpty())
                            <p class="text-muted">No default locations added yet.</p>
                        @else
                            <ul class="list-group mb-4">
                                @foreach ($user->defaultLocations as $location)
                                    <li class="list-group-item">
                                        <strong>{{ $location->name }}</strong> <br>
                                        {{ $location->address ?? '' }}
                                        {{ $location->city ?? '' }}, {{ $location->state ?? '' }}
                                        {{ $location->postal_code ?? '' }}, {{ $location->country ?? '' }} <br>
                                        <small>Lat: {{ $location->lat ?? 'N/A' }} | Lng: {{ $location->lng ?? 'N/A' }}</small><br>
                                        <span class="badge {{ $location->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $location->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @include('renter.profile.default-location.store', ['user' => $user])


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush
