@extends('auth.shell')

@section('auth-content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header text-center bg-primary text-white rounded-top-4 py-4">
                        <a href="{{ route('welcome') }}">
                            <img src="{{ asset('images/png/logo.png') }}" alt="Logo" class="mb-3" style="max-height: 60px;">
                        </a>
                        <h3 class="mb-0">Create Account</h3>
                        <p class="mb-0 small">Join the community today</p>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control rounded-3 @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email"
                                    class="form-control rounded-3 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Select Role</label>
                                <select id="role_id" name="role" class="form-select rounded-3" required>
                                    <option value="" selected disabled>-- Select a role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                                <div id="roleDescription" class="form-text mt-2"></div>
                                @error('role')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control rounded-3 @error('password') is-invalid @enderror" required
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control rounded-3 @error('password_confirmation') is-invalid @enderror"
                                    required autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit + Already Registered -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('login') }}" class="text-decoration-none">Already registered?</a>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
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
                    roleDescription.classList.add('alert', 'alert-info', 'py-2');
                } else {
                    roleDescription.textContent = '';
                    roleDescription.classList.remove('alert', 'alert-info', 'py-2');
                }
            });
        });
    </script>
@endsection