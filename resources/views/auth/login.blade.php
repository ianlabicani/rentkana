@extends('auth.shell')

@section('auth-content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 85vh;">
            <div class="col-md-9">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <!-- Left Image Section -->
                        <div class="col-lg-6 d-none d-lg-block bg-light">
                            <div class="h-100 p-4 d-flex flex-column justify-content-between"
                                style="background-color: rgb(228,216,205);">
                                <!--  LOGO AREA -->
                                <div class="text-center py-4">
                                    <a href="{{ route('welcome') }}">
                                        <img src="{{ asset('images/png/logo-removebg.png') }}" alt="RentKana Logo"
                                            class="img-fluid" style="max-height: 200px; width: 200px;">
                                    </a>
                                </div>
                                <div class="p-3">
                                    <h4 class="text-dark mb-3">Find Your Perfect Space</h4>
                                    <p class="text-muted mb-4">RentKana connects landlords and renters for a seamless room
                                        rental experience. Login to access your personalized dashboard.</p>
                                </div>
                                <div class="small text-muted text-center pb-3">
                                    &copy; 2025 RentKana. All rights reserved.
                                </div>
                            </div>
                        </div>

                        <!-- Right Login Form Section -->
                        <div class="col-lg-6">
                            <div class="card-body p-4 p-lg-5">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- ENLARGED LOGO FOR MOBILE VIEW -->
                                <div class="text-center mb-4 d-lg-none">
                                    <a href="{{ route('welcome') }}">
                                        <img src="{{ asset('images/png/logo-removebg.png') }}" alt="RentKana Logo"
                                            class="img-fluid mb-2" style="max-height: 120px; width: auto;">
                                    </a>
                                </div>

                                <h3 class="fw-bold mb-1">Welcome Back</h3>
                                <p class="text-muted mb-4">Please login to your account</p>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="far fa-envelope text-muted"></i>
                                            </span>
                                            <input id="email" type="email"
                                                class="form-control border-start-0 @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" placeholder="your@email.com"
                                                required autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="password" class="form-label">Password</label>
                                            @if (Route::has('password.request'))
                                                <a class="small text-decoration-none"
                                                    href="{{ route('password.request') }}">
                                                    Forgot password?
                                                </a>
                                            @endif
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0">
                                                <i class="fas fa-lock text-muted"></i>
                                            </span>
                                            <input id="password" type="password"
                                                class="form-control border-start-0 @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter Password" required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                        <label class="form-check-label" for="remember_me">Remember me</label>
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary py-2 fw-medium">
                                            Log In
                                        </button>
                                    </div>

                                    <div class="text-center">
                                        <span class="text-muted">Don't have an account?</span>
                                        <a href="{{ route('register') }}" class="text-decoration-none fw-medium ms-1">Sign
                                            up</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection