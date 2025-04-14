@extends('shell')

@section('content')
    @include('_ui.sessions')

    @auth
        @if (Auth::user()->isAdmin())
            @include('admin._ui.navbar')
        @elseif (Auth::user()->isLandlord())
            @include('landlord._ui.navbar')

        @endif
    @else
        @include('guest._ui.navbar-section')
    @endauth


    @include('_ui.hero-section')

    @include('_ui.team-composition')

    @include('_ui.discover-section')

    @include('_ui.careers-section')

@endsection