<section class="bg-hero text-black min-vh-100 text-center d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h2 class="display-3 fw-bold mb-3">Discover Affordable</h2>
        <p class="fs-1 fw-bold mb-4">Rooms for Rent in Your Area</p>

        <h5 class="footer-text p-3 mb-4">
            Rentkana: Connecting Landlords and Renters <br>
            for Seamless Room Rental Experience
        </h5>

        <a href="#" class="btn btn-login hover-btn-login me-2 text-white mb-3 mb-md-0">Explore Now</a>

        <div class="p-2"></div>

        <a href="#" class="footer-text text-black text-center text-decoration-none hover-underline">Browse Listings</a>
        <!-- @auth
        @if (Auth::user()->roles->first()->name == 'landlord')
        <a href="{{ route('landlord.dashboard') }}" class="btn btn-light">Dashboard</a>
        @elseif (Auth::user()->roles->first()->name == 'renter')
        <a href="{{ route('renter.dashboard') }}" class="btn btn-light">Dashboard</a>
        @elseif (Auth::user()->roles->first()->name == 'admin')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light">Dashboard</a>
        @endif
        @else
        <a href="{{ url('') }}" class="btn btn-light">Get
            Started</a>

        @endauth -->
    </div>
</section>