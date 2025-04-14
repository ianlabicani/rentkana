@extends('shell')

@section('content')
    @include('landlord._ui.navbar')
    <main class="py-3">
        @yield('landlord-content')
    </main>
@endsection