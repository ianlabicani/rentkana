@extends('auth.shell')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ old('email') }}" required autocomplete="username">
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Role Selection -->
                            <div class="mb-3">
                                <label for="role_id" class="form-label">Select Role</label>
                                <select id="role_id" name="role_id" class="form-select" required>
                                    <option value="" selected disabled>-- Select a role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="roleDescription" class="form-text mt-2"></div>
                                @error('role_id')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" required
                                    autocomplete="new-password">
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" required autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Already registered? -->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('login') }}" class="text-decoration-none">Already registered?</a>
                                <button type="submit" class="btn btn-primary">Register</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role_id');
            const roleDescription = document.getElementById('roleDescription');
            const roleDescriptions = @json($roleDescriptions);

            roleSelect.addEventListener('change', function() {
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
