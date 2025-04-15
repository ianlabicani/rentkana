<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rentkana</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        .feedback-btn {
            position: fixed;
            bottom: 50px;
            right: 50px;
        }
    </style>

</head>

<body>
    @auth
        @if (Auth::user()->isAdmin())
            @include('admin._ui.navbar')
        @elseif (Auth::user()->isLandlord())
            @include('landlord._ui.navbar')
        @endif
    @else
        @include('guest._ui.navbar-section')
    @endauth


    @yield('content')
    @include('shared.modals.coming-soon')

    <!-- Feedback Floating Button -->
    @include('shared.modals.feedback')


    @include('_ui.footer-section')
    @stack('scripts')
</body>

</html>