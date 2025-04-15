<section id="featured-rooms" class="py-5" style="background-color: #fffefe;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center mb-3">Featured Rooms</h2>
                <p class="text-center text-muted mb-5">Check out some of our popular listings from trusted landlords</p>
            </div>
        </div>

        <div class="row">
            @include('_ui.cards.list-of-rooms-card')
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <a href="{{-- route('rooms.index') --}}" class="btn btn-outline-primary">View All Rooms</a>
            </div>
        </div>
    </div>
</section>