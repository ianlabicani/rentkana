@extends('shell')

@section('content')
    @include('guest._ui.navbar-section')

    <main>
        @yield('guest-content')
    </main>
@endsection