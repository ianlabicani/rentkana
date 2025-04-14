@extends('shell')

@section('content')
    @include('_ui.sessions')

    <main class="container my-4">
        <h2 class="mb-4">My Profile</h2>

        <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $profile?->phone }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control">{{ $profile?->bio }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" id="saveBtn" disabled>Save</button>
                </div>
            </div>
        </form>
    </main>

    @push('scripts')
        <script>
            const form = document.getElementById('profileForm');
            const saveBtn = document.getElementById('saveBtn');
            const inputs = form.querySelectorAll('input, textarea');

            let initialData = Array.from(inputs).map(input => input.value);

            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    let hasChanged = Array.from(inputs).some((input, i) => input.value !== initialData[i]);
                    saveBtn.disabled = !hasChanged;
                });
            });
        </script>
    @endpush
@endsection