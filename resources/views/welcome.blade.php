<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        @if (Route::has('login'))
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}"> Dashboard</a>
                @else
                    <a href="{{ route('login') }}"> Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"> Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
</body>

</html>