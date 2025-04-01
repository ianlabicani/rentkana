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
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
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

    <!-- Team Composition Section -->
    @include('ui.team-composition')

    <!-- Careers Section -->
    @include('ui.careers-section')

    <!-- Footer -->
    <footer class="py-3 bg-dark text-center text-white">
        <p class="mb-0">&copy; {{ date('Y') }} Laravel App. All rights reserved.</p>
    </footer>

    {{-- modals --}}
    @include('coming-soon')
</body>

</html>