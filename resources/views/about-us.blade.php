@extends('shell')

@section('title', 'About Us - XearHance')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">About XearHance</h1>
            <p class="lead">Connecting renters and landlords for a smoother, smarter rental experience.</p>
        </div>

        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="fw-semibold">Our Mission</h2>
                <p>
                    At XearHance, we aim to simplify the renting process by creating a reliable and user-friendly platform
                    that bridges the gap between landlords and tenants. Whether you’re looking for a place to stay or
                    seeking trusted renters, XearHance makes the journey stress-free.
                </p>
            </div>
            <div class="col-md-6">
                <img src="https://armiet.in/wp-content/uploads/2019/10/Our-Vision-1.jpg" alt="Our Mission"
                    class="img-fluid rounded-3 shadow-sm mx-auto d-block" width="350px">
            </div>
        </div>

        <div class="row mb-5 align-items-center">
            <div class="col-md-6 order-md-2">
                <h2 class="fw-semibold">What We Offer</h2>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle text-success me-2"></i> Verified room listings</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Direct messaging with landlords</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Secure and easy-to-use interface</li>
                    <li><i class="fas fa-check-circle text-success me-2"></i> Community reviews and ratings</li>
                </ul>
            </div>
            <div class="col-md-6 order-md-1">
                <img src="https://cdn-icons-png.flaticon.com/512/6954/6954319.png" alt="Features"
                    class="img-fluid rounded-3 shadow-sm mx-auto d-block" width="300px">
            </div>
        </div>

        @include('_ui.team-composition')
    </div>
@endsection