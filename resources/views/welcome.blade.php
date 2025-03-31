<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="bg-light">

    <!-- Header with Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">RentKana</a>

            @if (Route::has('login'))
                <div class="ms-auto">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="display-4">Welcome to Laravel!</h2>
            <p class="lead">A powerful PHP framework for building modern web applications.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg mt-3">Get Started</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-3 bg-dark text-center text-white">
        <p class="mb-0">&copy; {{ date('Y') }} Laravel App. All rights reserved.</p>
    </footer>
</body>

</html>