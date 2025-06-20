@php
    $team = [
        [
            'name' => 'Ian',
            'role' => 'Tech Lead',
            'image' => asset('images/team/ian.jpg'),
            'description' => 'Oversees development and ensures XearHance delivers a seamless experience.',
        ],
        [
            'name' => 'Aedrian',
            'role' => 'Backend Developer',
            'image' => asset('images/team/aedrian.jpg'),
            'description' => 'Responsible for developing the backend of XearHance.',
        ],
        [
            'name' => 'Arnold',
            'role' => 'Backend Developer',
            'image' => asset('images/team/arnold.jpg'),
            'description' => 'Optimizing performance and ensuring backend efficiency.',
        ],
        [
            'name' => 'Bryan',
            'role' => 'Full-stack Developer',
            'image' => asset('images/team/bryan.jpg'),
            'description' => 'Ensuring a smooth and secure backend infrastructure.',
        ],
        [
            'name' => 'Erman',
            'role' => 'Full-stack Developer',
            'image' => asset('images/team/erman.jpg'),
            'description' => 'Bridging the backend and frontend for a seamless experience.',
        ],
        [
            'name' => 'Roceldi',
            'role' => 'Backend Developer',
            'image' => asset('images/team/roceldi.jpg'),
            'description' => 'Building an intuitive and visually appealing user experience.',
        ],
        [
            'name' => 'Harry',
            'role' => 'Frontend Developer & UI/UX',
            'image' => asset('images/team/harry.jpg'),
            'description' => 'Crafting responsive and interactive user interfaces.',
        ],
        [
            'name' => 'Jayson',
            'role' => 'UI/UX Designer',
            'image' => asset('images/team/jayson.jpg'),
            'description' => 'Designing XearHance\'s sleek and user-friendly interface.',
        ],
        [
            'name' => 'Harvey',
            'role' => 'Backend Developer',
            'image' => asset('images/team/jan.jpg'),
            'description' => 'Focused on building efficient, scalable, and maintainable server-side systems',
        ],

    ];
@endphp

<section class="py-5 bg-white text-center">
    <div class="container">
        <h2 class="display-5 fw-bold">Meet Our Current Team</h2>
        <p class="lead">The people behind XearHance</p>
        <p class="mb-4">XearHance is proudly built by a passionate team of student developers and designers dedicated to
            real-world impact.</p>

        <div class="row mt-4 g-4">
            @foreach($team as $member)
                @include('_ui.cards.team-composition-card', ['name' => $member['name'], 'role' => $member['role'], 'image' => $member['image'], 'description' => $member['description'],])
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.member-card').forEach((card) => {
            card.addEventListener('click', () => {
                const rect = card.getBoundingClientRect();

                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                confetti({
                    particleCount: 150,
                    spread: 70,
                    origin: {
                        x: centerX / window.innerWidth,
                        y: centerY / window.innerHeight
                    }
                });
            });
        });
    </script>
@endpush