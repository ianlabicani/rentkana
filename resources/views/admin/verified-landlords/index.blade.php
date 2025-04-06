@extends('admin.shell')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Pending Verifications --}}
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>Pending Landlord Verifications</h1>
            </div>

            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date Registered</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingLandlords as $verification)
                            <tr>
                                <td>{{ $verification->user->name }}</td>
                                <td>{{ $verification->user->email }}</td>
                                <td>{{ $verification->user->created_at->format('M d, Y') }}</td>
                                <td>{{ $verification->remarks ?? '—' }}</td>
                                <td class="d-flex gap-1">
                                    <form action="{{ route('admin.verified-landlords.approve', $verification->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.verified-landlords.reject', $verification->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="alert alert-info">
                                    <div class="alert alert-info mb-0">No one to verify yet.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $pendingLandlords->links() }}
                </div>
            </div>

            {{-- Verified & Rejected --}}
            <div class="col-md-12 d-flex justify-content-between align-items-center mt-5">
                <h1>Verified / Rejected Landlords</h1>
            </div>

            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Verified At</th>
                            <th>Verified By</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($otherLandlords as $verification)
                            <tr>
                                <td>{{ $verification->user->name }}</td>
                                <td>{{ $verification->user->email }}</td>
                                <td class="text-capitalize">{{ $verification->status }}</td>
                                <td>{{ $verification->verified_at ? $verification->verified_at->format('M d, Y') : '—' }}</td>
                                <td>{{ $verification->verifiedBy->name ?? '—' }}</td>
                                <td>{{ $verification->remarks ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="alert alert-info">
                                    <div class="alert alert-info mb-0">No verified or rejected landlords found.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $otherLandlords->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection