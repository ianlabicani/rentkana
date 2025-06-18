@extends('shell')

@section('content')
    <main>
        @yield('guest-content')
    </main>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (navigator.geolocation) {
                    window._geoWatchId = navigator.geolocation.watchPosition(function (position) {
                        window._userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        document.dispatchEvent(new CustomEvent('user-location-available', { detail: window._userLocation }));
                    }, function (error) {
                        window._userLocation = null;
                        document.dispatchEvent(new CustomEvent('user-location-unavailable'));
                    });
                } else {
                    window._userLocation = null;
                    document.dispatchEvent(new CustomEvent('user-location-unavailable'));
                }
            });
        </script>
    @endpush
@endsection