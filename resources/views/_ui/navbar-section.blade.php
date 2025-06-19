<nav class="navbar navbar-expand-lg bg-navbar shadow-sm">
    <div class="container">
        <img src="{{ asset('images/png/logo.png') }}" alt="logo" height="40" class="me-3">
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">InstaStay</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                    href="{{ route('admin.dashboard') }} ">Dashboard</a>
                            </li>
                        @elseif (Auth::user()->hasRole('landlord'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}"
                                    href="{{ route('landlord.dashboard') }}">Dashboard</a>
                            </li>
                        @elseif (Auth::user()->hasRole('renter'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('renter.dashboard') ? 'active' : '' }}"
                                    href="{{ route('renter.dashboard') }}">Dashboard</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rooms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Landlords</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reviews</a>
                        </li>
                        <div class="d-inline-block mt-2 mt-lg-0">
                            <a href="{{ route('login') }}" class="btn btn-login hover-btn-login me-2 text-white">Log in</a>
                            <a href="{{ route('register') }}" class="btn btn-login-outline hover-btn-login">Register</a>
                        </div>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>