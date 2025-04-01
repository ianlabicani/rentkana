<div class="col-md-3 mb-3">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">
        <div class="position-relative">
            <img src="{{ $image }}" class="rounded-circle mx-auto d-block mt-2 border-4 border-white" width="120"
                height="120" alt="{{ $name }}">
        </div>
        <div class="card-body text-center">
            <h5 class="fw-bold text-dark mb-2" style="font-size: 1.25rem;">{{ $name }}</h5>
            <p class="text-muted mb-3" style="font-size: 0.875rem;">{{ $role }} ({{ $year_level }})</p>
            <p class="text-muted small mb-4" style="font-size: 0.875rem;">{{ $description }}</p>
        </div>
    </div>
</div>