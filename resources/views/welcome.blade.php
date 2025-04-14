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

    @auth
        @if (Auth::user()->isAdmin())
            @include('admin._ui.navbar')
        @endif
    @else
        @include('_ui.navbar-section')
    @endauth


    @include('_ui.hero-section')

    @include('_ui.team-composition')

    @include('_ui.discover-section')

    @include('_ui.careers-section')


    @include('_ui.footer-section')

</html>

{{-- modals --}}
@include('coming-soon')

{{-- scripts --}}
@stack('scripts')
</body>

</html>