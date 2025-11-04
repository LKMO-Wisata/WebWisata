<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Watersplash Park</title> {{-- Judul diperbaiki --}}
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: Tambahkan font kustom jika perlu */
    </style>
</head>
<body class="bg-gray-50 font-sans">

   @include('layouts.navbar')

<header id="hero-section"
    class="relative h-[75vh] bg-center bg-cover transition-all duration-500 ease-in-out"
    style="background-image: url('{{ asset('img/homepage1.jpeg') }}');
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 flex flex-col items-center justify-center text-center h-full px-6">
        <h1 class="font-extrabold"
            style="color: #FDEB9E; text-shadow: 0 3px 4px rgba(255, 255, 255, 0.34); font-family: 'Roboto', sans-serif; font-size: 60px; line-height: 1.1;"> {{-- Line height disesuaikan --}}
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
    if (heroSection) { 
        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            heroSection.style.backgroundImage = `url('${images[currentIndex]}')`;
        }, 1500); 
    }
</script>

    <section class="py-16 bg-white">
        <div class="container mx-auto text-center px-4"> 
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Jam Operasional Wondersplash Park</h2>
            <div class="flex flex-col md:flex-row justify-center items-center gap-8">
                <div class="bg-blue-100 text-blue-900 rounded-xl p-8 w-full md:w-auto md:min-w-[300px] shadow-md"> 
                    <h3 class="text-xl font-semibold mb-2">Senin - Jumat</h3>
                    <p class="text-3xl md:text-4xl font-bold">08.00 - 20.00 WIB</p>
                </div>
                <div class="bg-blue-100 text-blue-900 rounded-xl p-8 w-full md:w-auto md:min-w-[300px] shadow-md"> 
                    <h3 class="text-xl font-semibold mb-2">Sabtu, Minggu & Libur Nasional</h3>
                    <p class="text-3xl md:text-4xl font-bold">07.00 - 21.00 WIB</p>
                </div>
            </div>
        </div>
    </section>

    @php
    
    $wahanaDataHomepage = [

        ['nama' => 'Bumper Cars',       'gambar' => 'img/wahana/wahana1.jpeg',  'slug' => 'Bumper Cars'], 
        ['nama' => 'Drop Tower',       'gambar' => 'img/wahana/wahana2.jpeg',  'slug' => 'Drop Tower'],
        ['nama' => 'Fantasy Voyage',   'gambar' => 'img/wahana/wahana3.jpeg',  'slug' => 'Fantasy Voyage'],
        ['nama' => 'Mini Bumper Blast','gambar' => 'img/wahana/wahana4.jpeg',  'slug' => 'Mini Bumper Blast'], 
        ['nama' => 'Mini Glowtopus Spin','gambar' => 'img/wahana/wahana5.jpeg', 'slug' => 'Mini Glowtopus Spin'], 
        ['nama' => 'Pirate Ship',      'gambar' => 'img/wahana/wahana6.jpeg',  'slug' => 'Pirate Ship'], 
        ['nama' => 'Rapid River Splash','gambar' => 'img/wahana/wahana7.jpeg', 'slug' => 'Rapid River Splash'],
        ['nama' => 'Rush Rider',       'gambar' => 'img/wahana/wahana8.jpeg',  'slug' => 'Rush Rider'],
        ['nama' => 'Sky Wheel',        'gambar' => 'img/wahana/wahana9.jpeg',  'slug' => 'Sky Wheel'],
        ['nama' => 'Swan Lake Paddle', 'gambar' => 'img/wahana/wahana10.jpeg', 'slug' => 'Swan Lake Paddle'],
        ['nama' => 'Trampland',        'gambar' => 'img/wahana/wahana11.jpeg', 'slug' => 'Trampland'],
        ['nama' => 'Twinkle Carousel', 'gambar' => 'img/wahana/wahana12.jpeg', 'slug' => 'Twinkle Carousel'],
    ];
    $itemsPerSlide = 3;
    $totalSlides = ceil(count($wahanaDataHomepage) / $itemsPerSlide);
@endphp

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12">
            Jelajahi Wahana
        </h2>

        <div class="flex justify-center items-center space-x-4">
            <button id="prevBtn" class="p-2 rounded-full bg-white border border-gray-300 text-gray-600 hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed"> {{-- Style tombol disesuaikan --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/> </svg>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl overflow-hidden" id="wahanaContainer"> {{-- Max-width agar tidak terlalu lebar --}}
                <div class="col-span-full text-center py-10 text-gray-500">Memuat wahana...</div>
            </div>

            <button id="nextBtn" class="p-2 rounded-full bg-white border border-gray-300 text-gray-600 hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed"> {{-- Style tombol disesuaikan --}}
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/> </svg>
            </button>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() { // Pastikan DOM siap

    const wahanaDataJs = @json($wahanaDataHomepage); 
    const itemsPerSlideJs = {{ $itemsPerSlide }};
    const totalSlidesJs = Math.ceil(wahanaDataJs.length / itemsPerSlideJs);
    let currentSlideJs = 0;

    const containerJs = document.getElementById('wahanaContainer');
    const prevBtnJs = document.getElementById('prevBtn');
    const nextBtnJs = document.getElementById('nextBtn');

    function renderSlideHomepage(slideIndex) {
        if (!containerJs) return; 
        containerJs.innerHTML = ""; 
        
        const start = slideIndex * itemsPerSlideJs;

        const itemsToShow = wahanaDataJs.slice(start, start + itemsPerSlideJs); 

        if (!itemsToShow || itemsToShow.length === 0) {
             containerJs.innerHTML = '<p class="col-span-full text-center py-10 text-gray-500">Tidak ada wahana.</p>';
             updateHomepageButtons();
             return;
        }

        itemsToShow.forEach((item, i) => { // Sekarang 'item' adalah object
             // ✅ Buat URL Gambar & Detail dari 'item'
             const imageUrl = `{{ asset('') }}${item.gambar}`;
             // Buat slug manual jika perlu (atau gunakan slug dari data jika sudah URL-safe)
             const safeSlug = (item.slug || '').toString().toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-').replace(/^-+/, '').replace(/-+$/, '');
             const detailUrl = `/wahana/${safeSlug}`; // Arahkan ke route detail

            containerJs.innerHTML += `
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 transform hover:scale-105"> {{-- Efek hover ditambahkan --}}
                    <img src="${imageUrl}" 
                         alt="${item.nama}" 
                         class="h-56 w-full object-cover">
                    <div class="p-5 bg-sky-100"> {{-- Warna background disesuaikan --}}
                        <p class="text-sm font-semibold uppercase tracking-wider text-gray-800 mb-1">${item.nama}</p> {{-- Style nama disesuaikan --}}
                        {{-- ✅ UBAH: href diisi detailUrl --}}
                        <a href="${detailUrl}" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">Lihat Detail</a> 
                    </div>
                </div>
            `;
        });
        updateHomepageButtons(); // Update tombol setelah render
    }
    
    // ✅ Fungsi update tombol (lebih baik untuk non-circular slider)
    function updateHomepageButtons() {
        if (!prevBtnJs || !nextBtnJs) return;
        prevBtnJs.disabled = currentSlideJs === 0;
        nextBtnJs.disabled = currentSlideJs >= totalSlidesJs - 1 || wahanaDataJs.length <= itemsPerSlideJs;
    }

    // Event listener tombol kanan (tanpa modulo)
    if (nextBtnJs) {
        nextBtnJs.addEventListener('click', () => {
            if (currentSlideJs < totalSlidesJs - 1) {
                currentSlideJs++;
                renderSlideHomepage(currentSlideJs);
            }
        });
    }

    // Event listener tombol kiri (tanpa modulo)
    if (prevBtnJs) {
        prevBtnJs.addEventListener('click', () => {
            if (currentSlideJs > 0) {
                currentSlideJs--;
                renderSlideHomepage(currentSlideJs);
            }
        });
    }

    // Render awal
    renderSlideHomepage(0);
});
</script>

@include('layouts.footer')

</body>
</html>