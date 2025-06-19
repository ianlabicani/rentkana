@extends('landlord.shell')

@section('title', 'Dashboard')

@section('landlord-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1>Dashboard</h1>
            </div>

            <div class="col-md-12 mt-3">
                <p>Welcome to your dashboard, {{ Auth::user()->name }}!</p>
            </div>

            <div class="col-md-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Room Statistics</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <h4 id="roomCount">0</h4>
                                <p>Total Rooms</p>
                            </div>
                            <div class="col-md-8">
                                <canvas id="roomsLocationChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch("{{ route('landlord.dashboard.rooms.data') }}")
                .then(res => res.json())
                .then(data => {
                    document.getElementById('roomCount').textContent = data.count;
                    const ctx = document.getElementById('roomsLocationChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: data.locations.labels,
                            datasets: [{
                                data: data.locations.counts,
                                backgroundColor: [
                                    '#0d6efd', '#6c757d', '#198754', '#ffc107', '#dc3545', '#6610f2', '#20c997', '#fd7e14'
                                ],
                            }]
                        },
                        options: {
                            plugins: {
                                legend: { position: 'bottom' }
                            }
                        }
                    });
                });
        });
    </script>
@endpush