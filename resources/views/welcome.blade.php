<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-light">

    {{-- sesssions --}}
    @include('_ui.sessions')


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



    @include('_ui.hero-section')

    @include('_ui.team-composition')


    @include('_ui.careers-section')


    <footer class="bg-navbar footer-text py-4">
        <div class="container">
            <div class="row align-items-center text-center text-md-start">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="d-flex flex-column justify-content-center justify-content-md-start align-items-center align-items-md-start">
                        <div class="logo-container">
                            <img src="{{ asset('images/png/logo2.png') }}" alt="logo" height="40" class="me-3">
                        </div>
                        <div class="small">© 2025 Rentkana, Inc.<br>All rights reserved.</div>
                    </div>
                </div>

                <div class="col-md-2 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Company</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Careers</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Explore</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Room Types</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Locations</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Pricing</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Partner Landlords</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Connect</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Facebook</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Twitter</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">Instagram</a></li>
                        <li class="mb-2"><a href="#" class="text-black text-decoration-none">LinkedIn</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</html>

{{-- modals --}}
@include('coming-soon')

{{-- scripts --}}
@stack('scripts')
</body>

</html>