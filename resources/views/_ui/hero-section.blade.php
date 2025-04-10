<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="display-4">Welcome to RentKana!</h2>
        <p class="lead">Find the perfect place to stay. Connecting landlords with renters seamlessly.</p>

        @auth
        @if (Auth::user()->roles->first()->name == 'landlord')
        <a href="{{ route('landlord.dashboard') }}" class="btn btn-light">Dashboard</a>
        @elseif (Auth::user()->roles->first()->name == 'renter')
        <a href="{{ route('renter.dashboard') }}" class="btn btn-light">Dashboard</a>
        @elseif (Auth::user()->roles->first()->name == 'admin')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light">Dashboard</a>
        @endif
        @else
        <a href="{{ url('') }}" class="btn btn-light">Get
            Started</a>

        @endauth

    </div>
</section>