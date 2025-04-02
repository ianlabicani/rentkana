<!-- Careers Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 fw-bold text-center">🚀 Join Our Team</h2>
        <p class="lead text-muted text-center">We're looking for talented individuals to join our growing team.</p>

        <!-- Open Positions -->
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <!-- Card for UI/UX Designer -->
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-paint-brush fa-3x text-primary mb-3"></i>
                        <h5 class="card-title fw-bold">UI/UX Designer</h5>
                        <p class="card-text text-muted">Help us design intuitive and visually appealing user
                            experiences.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <!-- Card for Frontend Developer -->
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-code fa-3x text-success mb-3"></i>
                        <h5 class="card-title fw-bold">Frontend Developer</h5>
                        <p class="card-text text-muted">Develop responsive and dynamic user interfaces for our platform.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <!-- Card for Backend Developer -->
                <div class="card shadow-lg border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-database fa-3x text-danger mb-3"></i>
                        <h5 class="card-title fw-bold">Backend Developer</h5>
                        <p class="card-text text-muted">Build and maintain robust server-side logic for our system.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Form -->
        <div class="mt-5">
            <h4 class="fw-bold text-center">📩 Apply Now!</h4>
            <p class="text-muted text-center">Fill out the form below to get started.</p>

            <div class="row">
                <div class="col-12 col-md-6 mx-auto">
                    <form action="{{ route('career-applications.store') }}" method="POST"
                        class="p-4 bg-white shadow rounded">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Your Email</label>
                            <input type="email" class="form-control" name="email" placeholder="example@email.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Position</label>
                            <select class="form-select" name="position" required>
                                <option value="">Choose a Position</option>
                                <option value="UI/UX Designer">UI/UX Designer</option>
                                <option value="Frontend Developer">Frontend Developer</option>
                                <option value="Backend Developer">Backend Developer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane"></i> Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>