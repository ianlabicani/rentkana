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
    @include('ui.sessions')



    <!-- Header with Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">RentKana</a>
    
            @if (Route::has('login'))
                <div class="ms-auto">
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
                        <button class="btn btn-outline-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#comingSoonModal">Log in</button>
                        @if (Route::has('register'))
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#comingSoonModal">Register</button>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>
    

    <!-- Hero Section -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="display-4">Welcome to RentKana!</h2>
            <p class="lead">Find the perfect place to stay. Connecting landlords with renters seamlessly.</p>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#comingSoonModal">Get
                Started</button>
        </div>
    </section>


    @include('ui.team-composition')


    @include('ui.careers-section')


    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row align-items-center text-center text-md-start">

                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="d-flex justify-content-center justify-content-md-start align-items-center">
                        <img src="{{ asset('images/png/logo.png') }}" alt="logo" height="40" class="me-3">
                    </div>
                </div>


                <div class="col-md-4 mb-3 mb-md-0">
                    <h6 class="text-uppercase mb-3">Navigation</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Contact</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Terms of Service</a></li>
                    </ul>
                </div>


                <div class="col-md-4 text-center text-md-end">
                    <a href="#" target="_blank" class="text-white me-3 text-decoration-none">
                        <i class="fa-brands fa-facebook fs-2"></i>
                    </a>
                    <a href="#" target="_blank" class="text-white me-3 text-decoration-none">
                        <i class="fa-brands fa-square-x-twitter fs-2"></i>
                    </a>
                    <a href="#" target="_blank" class="text-white me-3 text-decoration-none">
                        <i class="fa-brands fa-linkedin fs-2"></i>
                    </a>
                    <a href="#" target="_blank" class="text-white text-decoration-none">
                        <i class="fa-brands fa-instagram fs-2"></i>
                    </a>
                </div>
            </div>

            <div class="row mt-4 pt-2 border-top border-secondary text-center text-md-start">
                <div class="col-md-6 small text-white mb-2 mb-md-0">
                    © {{ date('Y') }} Rentana Inc. All rights reserved.
                </div>
                <div class="col-md-6 text-md-end small">
                    <a href="#" class="text-white text-decoration-none">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- modals --}}
    @include('coming-soon')

    {{-- scripts --}}
    @stack('scripts')
</body>

</html>
