<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="@yield('meta_description', 'Find and manage boarding houses with RentKana – a platform built for students and landlords to connect efficiently.')">
    <meta name="keywords"
        content="@yield('meta_keywords', 'rentkana, boarding house, student rentals, room rentals, landlord portal, aparri boarding house')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="RentKana Team">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="@yield('og_title', 'RentKana')">
    <meta property="og:description" content="@yield('og_description', 'Boarding house rental made easy.')">
    <meta property="og:image" content="@yield('og_image', asset('default-og-image.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">




    <title>@yield('title', 'Default Page Title') | RentKana</title>

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
    @include('_ui.sessions')


    @auth
        @if (Auth::user()->isAdmin())
            @include('admin._ui.navbar')
        @elseif (Auth::user()->isLandlord())
            @include('landlord._ui.navbar')
        @elseif (Auth::user()->isRenter())
            @include('renter._ui.navbar')

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