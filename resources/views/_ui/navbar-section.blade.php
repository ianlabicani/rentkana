<nav class="navbar navbar-expand-lg bg-navbar shadow-sm">
    <div class="container">
        <img src="{{ asset('images/png/logo.png') }}" alt="logo" height="40" class="me-3">
        <a class="navbar-brand fw-bold" href="#">RentKana</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent" aria-controls="navbarContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarContent">
            <div class="navbar-items">

            </div>

            @if (Route::has('login'))
            <div class="ms-lg-auto">
                @auth
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                        ({{ Auth::user()->roles->first()->name ?? 'User' }})
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <div class="d-flex flex-column flex-lg-row align-items-start">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rent</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Landlords</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacts</a>
                        </li>
                    </ul>

                    <div class="d-inline-block mt-2 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-login hover-btn-login me-2 text-white">Log in</a>

                        <a href="{{ route('register') }}" class="btn btn-login-outline hover-btn-login">Register</a>
                        @endauth

                    </div>
                    @endif
                </div>
            </div>
</nav>