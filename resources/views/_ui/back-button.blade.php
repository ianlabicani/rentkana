@if (url()->previous() !== url()->current())
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
@endif