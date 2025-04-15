<!-- resources/views/_ui/landlord-section.blade.php -->
<section id="landlord-section" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-4 fw-bold mb-3">Earn More by Listing Your Room with RentKana</h2>
                <p class="lead mb-4">Reach hundreds of students in Aparri looking for their next boarding house.</p>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-3 me-3 text-white">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Free to Post</h5>
                                <p class="mb-0">No hidden fees or charges</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-3 me-3 text-white">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Trusted by Students</h5>
                                <p class="mb-0">Verified renters only</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-3 me-3 text-white">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Easy-to-use Dashboard</h5>
                                <p class="mb-0">Manage listings effortlessly</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-3 me-3 text-white">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Quality Tenants</h5>
                                <p class="mb-0">Connect with reliable renters</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex">
                    <a href="{{ route('register') }}?role=landlord" class="btn btn-primary btn-lg px-4 py-3">Register as
                        a Landlord</a>
                    <a href="{{-- route('landlord.learn-more') --}}"
                        class="btn btn-outline-primary btn-lg px-4 py-3">Learn More</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <span class="badge bg-primary mb-2">Landlord Dashboard Preview</span>
                            <h4 class="mb-0">Manage Your Listings</h4>
                        </div>
                        {{-- <img src="{{ asset('images/landlord-dashboard.jpg') }}" alt="Landlord Dashboard"
                            class="img-fluid rounded"> --}}
                        <div class="mt-4">
                            <div class="d-flex justify-content-between text-center">
                                <div>
                                    <h3 class="text-primary mb-0">95%</h3>
                                    <small class="text-muted">Occupancy Rate</small>
                                </div>
                                <div>
                                    <h3 class="text-primary mb-0">48h</h3>
                                    <small class="text-muted">Avg. Response Time</small>
                                </div>
                                <div>
                                    <h3 class="text-primary mb-0">4.8</h3>
                                    <small class="text-muted">Star Rating</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>