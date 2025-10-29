<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage|Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

   @include('layouts.navbar')

<!-- Hero Section -->
<header id="hero-section"
    class="relative h-[75vh] bg-center bg-cover transition-all duration-500 ease-in-out"
    style="background-image: url('{{ asset('img/homepage1.jpeg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <div class="relative z-10 flex flex-col items-center justify-center text-center h-full px-6">
        <h1 class="font-extrabold"
            style="
                color: #FDEB9E;
                text-shadow: 0 3px 4px rgba(255, 255, 255, 0.34);
                font-family: 'Roboto', sans-serif;
                font-size: 60px;
                line-height: 48px;
            ">
            Watersplash Park: Surga Kesegaran<br>Keluarga Anda!
        </h1>

        <a href="{{ url('/tiket') }}" 
           class="mt-6 bg-red-600 hover:bg-red-700 px-6 py-3 md:px-8 md:py-4 font-semibold rounded-lg text-white">
           Beli Tiket Sekarang
        </a>
    </div>
</header>

<script>
    const images = [
        "{{ asset('img/homepage1.jpeg') }}",
        "{{ asset('img/homepage2.jpeg') }}",
        "{{ asset('img/homepage3.jpeg') }}"
    ];

    let currentIndex = 0;
    const heroSection = document.getElementById('hero-section');

    setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;
        heroSection.style.backgroundImage = `url('${images[currentIndex]}')`;
    }, 1500);
</script>



    <!-- Jam Operasional -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Jam Operasional Wondersplash Park</h2>
            <div class="flex flex-col md:flex-row justify-center items-center gap-8">
                <div class="bg-blue-100 text-blue-900 rounded-xl p-8 w-full md:w-1/3 shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Senin - Jumat</h3>
                    <p class="text-4xl font-bold">08.00 - 20.00 WIB</p>
                </div>
                <div class="bg-blue-100 text-blue-900 rounded-xl p-8 w-full md:w-1/3 shadow-md">
                    <h3 class="text-xl font-semibold mb-2">Khusus Sabtu, Minggu & Libur Nasional</h3>
                    <p class="text-4xl font-bold">07.00 - 21.00 WIB</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Jelajahi Wahana -->
@php
$wahanaNames = [
    'Bumper Cars', 'Drop Tower', 'Fantasy Voyage', 'Mini Bumper Blast',
    'Mini Glowtopus Spin', 'Pirate Ship', 'Rapid River Splash', 'Rush Rider',
    'Sky Wheel', 'Swan Lake Paddle', 'Trampland', 'Twinkle Carousel',
];
$itemsPerSlide = 3;
$totalSlides = ceil(count($wahanaNames) / $itemsPerSlide);
@endphp

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12">
            Jelajahi Wahana
        </h2>

        <div class="flex justify-center items-center space-x-4">

            <!-- Tombol Kiri -->
            <button id="prevBtn" class="p-2 rounded-full border hover:bg-blue-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <!-- Container Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full" id="wahanaContainer">
                <!-- Card akan di-render ulang lewat JavaScript -->
            </div>

            <!-- Tombol Kanan -->
            <button id="nextBtn" class="p-2 rounded-full border hover:bg-blue-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

        </div>
    </div>
</section>

<script>
    const wahanaNames = @json($wahanaNames);
    const itemsPerSlide = 3;
    const totalSlides = Math.ceil(wahanaNames.length / itemsPerSlide);
    let currentSlide = 0;

    const container = document.getElementById('wahanaContainer');

    function renderSlide(slideIndex) {
        container.innerHTML = ""; // hapus isi lama
        const start = slideIndex * itemsPerSlide;
        const items = wahanaNames.slice(start, start + itemsPerSlide);

        items.forEach((name, i) => {
            container.innerHTML += `
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition duration-300">
                    <img src="/img/wahana/wahana${start + i + 1}.jpeg"
                         alt="${name}"
                         class="h-56 w-full object-cover">
                    <div class="p-5 bg-blue-50">
                        <p class="text-sm font-semibold text-blue-800">${name}</p>
                        <a href="#" class="text-lg font-bold text-blue-700 hover:underline">Lihat Detail</a>
                    </div>
                </div>
            `;
        });
    }

    // Tombol kanan → maju
    document.getElementById('nextBtn').addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % totalSlides;
        renderSlide(currentSlide);
    });

    // Tombol kiri → mundur (dari akhir)
    document.getElementById('prevBtn').addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        renderSlide(currentSlide);
    });

    // Render awal
    renderSlide(0);
</script>

@include('layouts.footer')

</body>
</html>
