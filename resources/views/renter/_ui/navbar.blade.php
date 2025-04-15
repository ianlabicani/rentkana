<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('renter.dashboard') }}">
            <img src="{{ asset('images/png/logo.png') }}" alt="RentKana Logo" class="img-fluid"
                style="max-width: 30px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.rooms.index') }}">
                        <i class="fas fa-bed"></i> Find Rooms
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                        <i class="fas fa-calendar-check"></i> My Bookings
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                        <i class="fas fa-heart"></i> Wishlist
                    </a>
                </li>
                <li class="nav-item">
                    <a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                        <i class="fas fa-envelope"></i> Messages
                        <span class="badge bg-danger">3</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ url('renter.profile.index') }}">
                                <i class="fas fa-user-cog"></i> Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ url('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i
                                        class="fas fa-sign-out-alt"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>