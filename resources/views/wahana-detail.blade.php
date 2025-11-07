<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- PERBAIKAN KRITIS: Menggunakan notasi objek (->) untuk properti Model --}}
    <title>{{ $wahana->nama }} | Watersplash Park</title> 
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style></style>
</head>
<body class="bg-white font-sans text-gray-900">

    @include('layouts.navbar')

    {{-- PERBAIKAN KRITIS: Menggunakan accessor 'primary_photo_url' untuk gambar utama --}}
    <div id="wahanaHeroBanner" 
      class="relative h-[60vh] md:h-[70vh] bg-cover bg-center cursor-pointer transition-all duration-300" 
      style="background-image: url('{{ $wahana->primary_photo_url ?? asset('img/no-image.png') }}');">
        
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 bg-gradient-to-t from-black via-black/70 to-transparent">
            <h1 class="text-3xl md:text-5xl font-bold text-white text-center uppercase tracking-wider">{{ $wahana->nama }}</h1>
        </div>
    </div>

    <section class="container mx-auto px-4 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            
            {{-- Kolom Ketentuan dan Tiket --}}
            <div class="md:col-span-1 space-y-6">
                <h2 class="text-xl font-semibold text-[#001B60] border-b pb-2">Ketentuan :</h2>
                <ul class="space-y-2 text-sm text-gray-700">
                    {{-- Properti 'ketentuan' di-cast sebagai array di Model, jadi notasi array [ ] benar --}}
                    @if(isset($wahana->ketentuan) && is_array($wahana->ketentuan))
                        @foreach ($wahana->ketentuan as $k)
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center mr-2 mt-0.5">
                                <i class="fas fa-info text-white text-xs"></i>
                            </span>
                            <span>{{ $k }}</span>
                        </li>
                        @endforeach
                    @else
                        <li>Informasi ketentuan belum tersedia.</li>
                    @endif
                </ul>
                <a href="{{ url('/tiket') }}" class="inline-block w-full text-center bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    Beli Tiket Sekarang
                </a>
            </div>

            {{-- Kolom Deskripsi --}}
            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold text-[#001B60] mb-4">{{ $wahana->nama }}</h2>
                <p class="text-gray-600 leading-relaxed text-justify">
                    {{ $wahana->deskripsi ?? 'Deskripsi wahana belum tersedia.' }}
                </p>
            </div>
        </div>
    </section>

    {{-- Jelajahi Wahana Lainnya (Slider) --}}
    @if(isset($others) && count($others) > 0)
        @php
            $wahanaSliderItems = $others;
            $itemsPerSlide = 3;
            $totalSlidesJS = ceil(count($wahanaSliderItems) / $itemsPerSlide);
        @endphp

        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-2xl font-bold text-[#001B60] text-center mb-12">
                    Jelajahi Wahana Lainnya
                </h2>
                <div class="flex justify-center items-center space-x-4">
                    {{-- Tombol Kiri --}}
                    <button id="prevBtnOther" class="p-2 rounded-full bg-white shadow-md text-gray-600 hover:bg-gray-100 hover:text-indigo-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/> </svg>
                    </button>
                    {{-- Container Card --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-5xl overflow-hidden" id="wahanaContainerOther">
                        <div class="text-center text-gray-500 py-10 col-span-full" id="loadingPlaceholder">Memuat wahana...</div>
                    </div>
                    {{-- Tombol Kanan --}}
                    <button id="nextBtnOther" class="p-2 rounded-full bg-white shadow-md text-gray-600 hover:bg-gray-100 hover:text-indigo-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/> </svg>
                    </button>
                </div>
            </div>
        </section>
    @else
        <section class="bg-gray-100 py-16">
             <div class="container mx-auto px-4">
                 <h2 class="text-2xl font-bold text-center text-[#001B60] mb-10">Jelajahi Wahana Lainnya</h2>
             </div>
        </section>
    @endif

    @include('layouts.footer')

    ---
    
    ## 🎯 Perbaikan Script Slider Wahana Lainnya

    {{-- Script Slider (Bagian ini sudah diperbaiki untuk menggunakan primary_photo_url) --}}
    @if(isset($others) && count($others) > 0)
        <script>
            const wahanaItemsOther = @json($wahanaSliderItems);
            const itemsPerSlideOther = {{ $itemsPerSlide }};
            const totalSlidesOther = Math.ceil(wahanaItemsOther.length / itemsPerSlideOther);
            let currentSlideOther = 0;

            const containerOther = document.getElementById('wahanaContainerOther');
            const prevBtnOther = document.getElementById('prevBtnOther');
            const nextBtnOther = document.getElementById('nextBtnOther');
            
            function renderSlideOther(slideIndex) {
                if (!containerOther) return;
                containerOther.innerHTML = ""; 

                const start = slideIndex * itemsPerSlideOther;
                const itemsToShow = wahanaItemsOther.slice(start, start + itemsPerSlideOther);

                if (!itemsToShow || itemsToShow.length === 0) {
                    containerOther.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada wahana.</p>';
                    updateButtonStatesOther();
                    return;
                }

                // Menggunakan grid-cols-3 yang konsisten
                containerOther.className = `grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-5xl overflow-hidden`;

                itemsToShow.forEach((item) => {
                    // PERBAIKAN KRITIS: Menggunakan 'primary_photo_url'
                    if (typeof item !== 'object' || item === null || !item.slug || !item.primary_photo_url || !item.nama) {
                        console.error("Invalid item data found (missing slug, photo, or name):", item);
                        return;
                    }

                    const safeSlug = item.slug.toString().toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-').replace(/^-+/, '').replace(/-+$/, '');
                    const detailUrl = `/wahana/${safeSlug}`;
                    let imageUrl = item.primary_photo_url; 

                    // PERBAIKAN UTAMA DI SINI: Menyalin gaya kartu dari homepage (Kode 2)
                    containerOther.innerHTML += `
                        <div class="bg-white rounded-lg **shadow-lg** overflow-hidden transition duration-300 **transform hover:scale-105**">
                            <img src="${imageUrl}" alt="${item.nama}" class="**h-56** w-full object-cover" **onerror="this.src='{{ asset('img/no-image.png') }}'"**>
                            <div class="**p-5 bg-sky-100**">
                                <p class="text-sm font-semibold uppercase tracking-wider text-gray-800 mb-1">${item.nama}</p>
                                <a href="${detailUrl}" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">Lihat Detail</a>
                            </div>
                        </div>
                    `;
                });

                updateButtonStatesOther();
            }

            function updateButtonStatesOther() {
                if (!prevBtnOther || !nextBtnOther) return;
                const canSlide = wahanaItemsOther.length > itemsPerSlideOther;
                prevBtnOther.disabled = !canSlide || currentSlideOther === 0;
                nextBtnOther.disabled = !canSlide || currentSlideOther >= totalSlidesOther - 1;
            }

            if (nextBtnOther) {
                nextBtnOther.addEventListener('click', () => {
                    if (totalSlidesOther <= 1) return;
                    if (currentSlideOther < totalSlidesOther - 1) {
                        currentSlideOther++;
                        renderSlideOther(currentSlideOther);
                    }
                });
            }

            if (prevBtnOther) {
                prevBtnOther.addEventListener('click', () => {
                    if (totalSlidesOther <= 1) return; 
                    if (currentSlideOther > 0) {
                        currentSlideOther--;
                        renderSlideOther(currentSlideOther);
                    }
                });
            } 

            if (containerOther && wahanaItemsOther.length > 0) {
                renderSlideOther(currentSlideOther);
            } else if (containerOther) {
                containerOther.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada wahana lainnya.</p>';
                if(prevBtnOther) prevBtnOther.disabled = true;
                if(nextBtnOther) nextBtnOther.disabled = true;
            }
        </script>
    @endif

    ---

    ## 🖼️ Script Banner Image Click (Tidak Berubah)

    {{-- Script Banner Image Click --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Perbaikan: Ambil path foto dari relasi photos
            const photos = @json($wahana->photos->pluck('path') ?? []);
            
            if (photos && photos.length > 1) {
                
                const heroBanner = document.getElementById('wahanaHeroBanner');
                let currentImageIndex = 0;

                heroBanner.addEventListener('click', function() {

                    currentImageIndex = (currentImageIndex + 1) % photos.length;
                    
                    // Gunakan asset() di JS karena photos berisi path relatif
                    let newImageUrl = `{{ asset('') }}${photos[currentImageIndex]}`;
                    newImageUrl = newImageUrl.replace(/([^:]\/)\/+/g, "$1"); // Bersihkan double slash

                    heroBanner.style.backgroundImage = `url('${newImageUrl}')`;
                });

            } else {

                const heroBanner = document.getElementById('wahanaHeroBanner');
                if (heroBanner) {
                    heroBanner.classList.remove('cursor-pointer');
                }
            }
        });
    </script>
</body>
</html>