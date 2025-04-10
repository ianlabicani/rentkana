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

    @include('_ui.navbar')

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