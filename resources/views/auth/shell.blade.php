@extends('shell')

@section('content')
    @include('guest._ui.navbar-section')

    <main>
        @yield('auth-content')
    </main>
@endsection