@extends('admin.shell')

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>Dashboard</h1>
            </div>

            <div class="col-md-12 mt-3">
                <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
            </div>
        </div>
        <h3 class="mb-4">User Feedback</h3>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Type</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->user?->name ?? 'Guest' }}</td>
                            <td>{{ $feedback->type ?? 'General' }}</td>
                            <td>{{ $feedback->message }}</td>
                            <td>{{ $feedback->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection