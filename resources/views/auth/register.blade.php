@extends('auth.shell')

@section('auth-content')
    <div class="container py-4 py-lg-5">
        <div class="row justify-content-center align-items-center" style="min-height: 85vh;">
            <div class="col-md-12">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <!-- Left Image Section -->
                        <div class="col-lg-4 d-none d-lg-block bg-light">
                            <div class="h-100 p-4 d-flex flex-column justify-content-between"
                                style="background-color: rgb(228,216,205);">
                                <!--  LOGO AREA -->
                                <div class="text-center py-4">
                                    <a href="{{ route('welcome') }}">
                                        <img src="{{ asset('images/png/logo-removebg.png') }}" alt="InstaStay Logo"
                                            class="img-fluid" style="max-height: 200px; width: 200px;">
                                    </a>
                                </div>
                                <div class="p-3">
                                    <h4 class="text-dark mb-3">Start Your Journey</h4>
                                    <p class="text-muted mb-4">Join InstaStay to discover affordable rooms or list your
                                        property.
                                        Create an account to get started with a seamless rental experience.</p>
                                </div>
                                <div class="small text-muted text-center pb-3">
                                    &copy; 2025 InstaStay. All rights reserved.
                                </div>
                            </div>
                        </div>

                        <!-- Right Registration Form Section -->
                        <div class="col-lg-8">
                            <div class="card-body p-3 p-sm-4 p-lg-5">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- IMPROVED LOGO FOR MOBILE VIEW -->
                                <div class="text-center mb-3 d-lg-none">
                                    <a href="{{ route('welcome') }}">
                                        <img src="{{ asset('images/png/logo-removebg.png') }}" alt="InstaStay Logo"
                                            class="img-fluid mb-2" style="max-height: 100px; width: auto;">
                                    </a>
                                </div>

                                <h3 class="fw-bold mb-1 text-center text-sm-start">Create Account</h3>
                                <p class="text-muted mb-3 mb-lg-4 text-center text-sm-start">Join the community today</p>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="far fa-user text-muted"></i>
                                                </span>
                                                <input type="text" id="name" name="name"
                                                    class="form-control border-start-0 @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" placeholder="Your full name" required
                                                    autofocus>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="far fa-envelope text-muted"></i>
                                                </span>
                                                <input type="email" id="email" name="email"
                                                    class="form-control border-start-0 @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" placeholder="your@email.com" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Role -->
                                        <div class="col-md-6 mb-3">
                                            <label for="role_id" class="form-label">Select Role</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-user-tag text-muted"></i>
                                                </span>
                                                <select id="role_id" name="role"
                                                    class="form-select border-start-0 @error('role') is-invalid @enderror"
                                                    required>
                                                    <option value="" selected disabled>-- Select a role --</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                                <input type="password" id="password" name="password"
                                                    class="form-control border-start-0 @error('password') is-invalid @enderror"
                                                    placeholder="Create a strong password" required>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Confirm Password -->
                                        <div class="col-12 mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <i class="fas fa-lock text-muted"></i>
                                                </span>
                                                <input type="password" id="password_confirmation"
                                                    name="password_confirmation" class="form-control border-start-0"
                                                    placeholder="Confirm your password" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Role Description -->
                                    <div id="roleDescription" class="form-text mt-2 mb-3"></div>

                                    <div class="d-grid gap-2 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary py-2 fw-medium">
                                            Register
                                        </button>
                                    </div>

                                    <div class="text-center mt-3">
                                        <span class="text-muted">Already have an account?</span>
                                        <a href="{{ route('login') }}" class="text-decoration-none fw-medium ms-1">Log
                                            in</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Footer -->
                <div class="d-lg-none text-center mt-3 small text-muted">
                    &copy; 2025 InstaStay. All rights reserved.
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role_id');
            const roleDescription = document.getElementById('roleDescription');
            const roleDescriptions = @json($roleDescriptions);

            roleSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const roleName = selectedOption.text;

                if (roleDescriptions[roleName]) {
                    roleDescription.textContent = roleDescriptions[roleName];
                    roleDescription.classList.add('alert', 'alert-info', 'py-2', 'mt-2');
                } else {
                    roleDescription.textContent = '';
                    roleDescription.classList.remove('alert', 'alert-info', 'py-2', 'mt-2');
                }
            });

            // Improve mobile form experience by adjusting form field focus
            const formInputs = document.querySelectorAll('input, select');
            formInputs.forEach(input => {
                input.addEventListener('focus', function () {
                    // Small delay to let keyboard appear
                    setTimeout(() => {
                        // Scroll the input into better view on mobile
                        this.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 300);
                });
            });
        });
    </script>
@endsection