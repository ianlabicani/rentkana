<section class="bg-navbar min-vh-100">
    <div class="container">
        <div class="row hero-section">
            <div class="col-lg-6 col-md-12 mb-md-4 mb-lg-0">
                <img src="{{ asset('images/png/discover.png') }}" alt="Modern Bedroom Interior" class="hero-image">
            </div>
            <div class="col-lg-6 col-md-12 content-section">
                <h1 class="tagline">Discover Your Next</h1>
                <h2 class="subtitle">Flexible Leasing Options</h2>
                <p class="description footer-text">
                    InstaStay is a platform connecting landlords and </br>
                    renters (students and workers), enabling </br>
                    landlords to list available rooms and renters </br>
                    to search and inquire about them
                </p>
                <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</section>


<style>
    .hero-section {
        padding: 3rem 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .hero-image {
        border-radius: 8px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .content-section {
        padding-left: 2.5rem;
    }

    .tagline {
        color: #333;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .subtitle {
        color: #555;
        font-size: 1.2rem;
        font-weight: 500;
        letter-spacing: 1px;
        margin-bottom: 1.5rem;
    }

    .description {
        color: #666;
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .cta-button {
        background-color: #2d2d2d;
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .cta-button:hover {
        background-color: #444;
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 991px) {
        .content-section {
            padding-left: 1rem;
            padding-top: 2rem;
        }

        .tagline {
            font-size: 2.2rem;
        }

        .hero-section {
            padding: 2rem 0;
        }
    }

    @media (max-width: 767px) {
        .hero-section {
            min-height: auto;
            padding: 3rem 0;
        }

        .tagline {
            font-size: 2rem;
        }

        .subtitle {
            font-size: 1.1rem;
        }
    }


    @media (max-width: 575px) {
        .hero-section {
            text-align: center;
        }

        .content-section {
            padding: 2rem 1rem 0;
        }

        .tagline {
            font-size: 1.8rem;
        }

        .hero-image {
            max-height: 350px;
        }
    }
</style>