<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #ratingHearts .fa-heart { transition: color 0.2s ease-in-out, transform 0.1s ease-in-out; }
        #ratingHearts .fa-heart:hover { transform: scale(1.15); }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    @include('layouts.navbar')

    @if (session('success'))
        <div class="container mx-auto px-6 py-4 mt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- HERO -->
    <header id="hero-section"
        class="relative h-[75vh] bg-center bg-cover transition-all duration-500 ease-in-out"
        style="background-image: url('{{ asset('img/homepage1.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center h-full px-6">
            <h1 class="font-extrabold"
                style="color: #FDEB9E; text-shadow: 0 3px 4px rgba(255, 255, 255, 0.34); font-family: 'Roboto', sans-serif; font-size: 60px; line-height: 1.1;">
                Watersplash Park: Surga Kesegaran<br>Keluarga Anda!
            </h1>
            <a href="{{ url('/tiket') }}"
               class="mt-6 bg-red-600 hover:bg-red-700 px-6 py-3 md:px-8 md:py-4 font-semibold rounded-lg text-white">
               Beli Tiket Sekarang
            </a>
        </div>
    </header>

    <!-- Jam Operasional -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Jam Operasional Watersplash Park</h2>
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

    <!-- Jelajahi Wahana (dinamis dari controller) -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12">
                Jelajahi Wahana
            </h2>

            <div class="flex justify-center items-center space-x-4">
                <button id="prevBtn"
                        class="p-2 rounded-full bg-white border border-gray-300 text-gray-600 hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Sebelumnya">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl overflow-hidden" id="wahanaContainer">
                    <div class="col-span-full text-center py-10 text-gray-500">Memuat wahana...</div>
                </div>

                <button id="nextBtn"
                        class="p-2 rounded-full bg-white border border-gray-300 text-gray-600 hover:bg-gray-100 transition disabled:opacity-50 disabled:cursor-not-allowed"
                        aria-label="Berikutnya">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Form Feedback -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="bg-white max-w-2xl mx-auto p-8 md:p-12 rounded-lg shadow-xl relative mt-10">
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-blue-600 p-5 rounded-full shadow-lg border-4 border-white">
                    <i class="fa-solid fa-pencil text-white text-2xl"></i>
                </div>

                <h2 class="text-2xl font-bold text-center text-gray-800 mt-8 mb-2">Masukan Anda adalah inspirasi kami.</h2>
                <p class="text-center text-gray-500 mb-6">Beri kami nilai!</p>

                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf

                    <!-- Rating -->
                    <div class="flex justify-center space-x-2 mb-6" id="ratingHearts">
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="1"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="2"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="3"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="4"></i>
                        <i class="fa-regular fa-heart text-gray-300 text-3xl cursor-pointer" data-value="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="0">

                    <!-- Fields -->
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                            <input type="email" name="email" id="email" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukan Email Anda">
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="name" id="name"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Masukan Nama Anda">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan*</label>
                            <textarea name="message" id="message" rows="4" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Tuliskan Masukan Anda disini..."></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-6">
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                            Kirim Masukan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <!-- Scripts -->
    <script>
        // Hero rotator sederhana
        (function() {
            const images = [
                "{{ asset('img/homepage1.jpeg') }}",
                "{{ asset('img/homepage2.jpeg') }}",
                "{{ asset('img/homepage3.jpeg') }}"
            ];
            let currentIndex = 0;
            const heroSection = document.getElementById('hero-section');
            if (!heroSection) return;

            setInterval(() => {
                currentIndex = (currentIndex + 1) % images.length;
                heroSection.style.backgroundImage = `url('${images[currentIndex]}')`;
            }, 3000);
        })();

        // Slider wahana dari data controller ($wahanaCards)
        document.addEventListener('DOMContentLoaded', function() {
            const wahanaDataJs = @json($wahanaCards ?? []);
            const itemsPerSlideJs = 3;
            const totalSlidesJs = Math.ceil((wahanaDataJs.length || 0) / itemsPerSlideJs);
            let currentSlideJs = 0;

            const containerJs = document.getElementById('wahanaContainer');
            const prevBtnJs = document.getElementById('prevBtn');
            const nextBtnJs = document.getElementById('nextBtn');

            function renderSlideHomepage(slideIndex) {
                if (!containerJs) return;
                containerJs.innerHTML = "";

                if (!wahanaDataJs || wahanaDataJs.length === 0) {
                    containerJs.innerHTML = '<p class="col-span-full text-center py-10 text-gray-500">Tidak ada wahana.</p>';
                    updateHomepageButtons();
                    return;
                }

                const start = slideIndex * itemsPerSlideJs;
                const itemsToShow = wahanaDataJs.slice(start, start + itemsPerSlideJs);

                itemsToShow.forEach((item) => {
                    const imageUrl = item.gambar_url || "{{ asset('img/no-image.png') }}";
                    const safeSlug = (item.slug || '').toString();
                    const detailUrl = `/wahana/${safeSlug}`;

                    containerJs.innerHTML += `
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 transform hover:scale-105">
                            <img src="${imageUrl}" alt="${item.nama || ''}" class="h-56 w-full object-cover" onerror="this.src='{{ asset('img/no-image.png') }}'">
                            <div class="p-5 bg-sky-100">
                                <p class="text-sm font-semibold uppercase tracking-wider text-gray-800 mb-1">${item.nama || '-'}</p>
                                <a href="${detailUrl}" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">Lihat Detail</a>
                            </div>
                        </div>
                    `;
                });

                updateHomepageButtons();
            }

            function updateHomepageButtons() {
                if (!prevBtnJs || !nextBtnJs) return;
                prevBtnJs.disabled = currentSlideJs === 0;
                nextBtnJs.disabled = currentSlideJs >= totalSlidesJs - 1 || wahanaDataJs.length <= itemsPerSlideJs;
            }

            nextBtnJs?.addEventListener('click', () => {
                if (currentSlideJs < totalSlidesJs - 1) {
                    currentSlideJs++;
                    renderSlideHomepage(currentSlideJs);
                }
            });

            prevBtnJs?.addEventListener('click', () => {
                if (currentSlideJs > 0) {
                    currentSlideJs--;
                    renderSlideHomepage(currentSlideJs);
                }
            });

            // Render pertama
            renderSlideHomepage(0);
        });

        // Rating hearts logic
        document.addEventListener('DOMContentLoaded', function() {
            const ratingContainer = document.getElementById('ratingHearts');
            if (!ratingContainer) return;

            const hearts = ratingContainer.querySelectorAll('.fa-heart');
            const ratingInput = document.getElementById('ratingInput');

            const updateRatingUI = (ratingValue) => {
                hearts.forEach((h, i) => {
                    if (i < ratingValue) {
                        h.classList.add('text-red-500', 'fa-solid');
                        h.classList.remove('text-gray-300', 'fa-regular');
                    } else {
                        h.classList.add('text-gray-300', 'fa-regular');
                        h.classList.remove('text-red-500', 'fa-solid');
                    }
                });
            };

            hearts.forEach((heart, index) => {
                heart.addEventListener('click', () => {
                    const ratingValue = index + 1;
                    ratingInput.value = ratingValue;
                    updateRatingUI(ratingValue);
                });

                heart.addEventListener('mouseover', () => {
                    const hoverValue = index + 1;
                    hearts.forEach((h, i) => {
                        if (i < hoverValue) {
                            h.classList.add('text-red-400');
                            h.classList.remove('text-gray-300');
                        } else {
                            h.classList.add('text-gray-300');
                            h.classList.remove('text-red-400');
                        }
                    });
                });
            });

            ratingContainer.addEventListener('mouseleave', () => {
                const currentRating = parseInt(ratingInput.value, 10) || 0;
                updateRatingUI(currentRating);
            });
        });
    </script>
</body>
</html>
