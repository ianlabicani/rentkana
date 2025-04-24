<nav class="navbar navbar-expand-lg bg-navbar shadow-sm">
    <div class="container">
        <img src="{{ asset('images/png/logo.png') }}" alt="logo" height="40" class="me-3">
        <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">RentKana</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('welcome') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guest.rooms.index') || request()->routeIs('guest.rooms.show') ? 'active' : '' }}"
                        href="{{ route('guest.rooms.index') }}">Rooms</a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                        Landlords
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#comingSoonModal">Contact
                        Us</a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-bs-toggle="modal"
                        data-bs-target="#comingSoonModal">Reviews</a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" href="{{ route('guest.about-us') }}">About us</a>
                </li>
                <div class="d-inline-block mt-2 mt-lg-0">
                    <a href="{{ route('login') }}" class="btn btn-login hover-btn-login me-2 text-white">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-login-outline hover-btn-login">Register</a>
                </div>
            </ul>
        </div>
    </div>
</nav>