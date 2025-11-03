<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wahana['nama'] }} | Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    </style>
</head>
<body class="bg-white font-sans text-gray-900">

    @include('layouts.navbar')

    <div class="relative h-[60vh] md:h-[70vh] bg-cover bg-center" style="background-image: url('{{ asset($wahana['gambar']) }}');">
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 bg-gradient-to-t from-black via-black/70 to-transparent">
            <h1 class="text-3xl md:text-5xl font-bold text-white text-center uppercase tracking-wider">{{ $wahana['nama'] }}</h1>
        </div>
    </div>

    <section class="container mx-auto px-4 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
            
            <div class="md:col-span-1 space-y-6">
                <h2 class="text-xl font-semibold text-[#001B60] border-b pb-2">Ketentuan :</h2>
                <ul class="space-y-2 text-sm text-gray-700">
                    @if(isset($wahana['ketentuan']) && is_array($wahana['ketentuan']))
                        @foreach ($wahana['ketentuan'] as $k)
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

            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold text-[#001B60] mb-4">{{ $wahana['nama'] }}</h2>
                <p class="text-gray-600 leading-relaxed text-justify">
                    {{ $wahana['deskripsi'] ?? 'Deskripsi wahana belum tersedia.' }}
                </p>
            </div>
        </div>
    </section>


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
                 <p class="text-center text-gray-500 col-span-full">Tidak ada wahana lainnya untuk ditampilkan.</p>
             </div>
         </section>
    @endif

    @include('layouts.footer')

    @if(isset($others) && count($others) > 0)
        <script>

            const wahanaItemsOther = @json($wahanaSliderItems);
            const itemsPerSlideOther = {{ $itemsPerSlide }};
            const totalSlidesOther = Math.ceil(wahanaItemsOther.length / itemsPerSlideOther);
            let currentSlideOther = 0;

            const containerOther = document.getElementById('wahanaContainerOther');
            const prevBtnOther = document.getElementById('prevBtnOther');
            const nextBtnOther = document.getElementById('nextBtnOther');
            const loadingPlaceholder = document.getElementById('loadingPlaceholder'); 

            console.log("Slider Data:", { totalItems: wahanaItemsOther.length, itemsPerSlide: itemsPerSlideOther, totalSlides: totalSlidesOther });
           

            function renderSlideOther(slideIndex) {
            
                console.log("Rendering Slide:", slideIndex);
             

                if (!containerOther) { console.error("Container 'wahanaContainerOther' not found."); return; }
                containerOther.innerHTML = ""; 

                const start = slideIndex * itemsPerSlideOther;
                const itemsToShow = wahanaItemsOther.slice(start, start + itemsPerSlideOther);

                if (!itemsToShow || itemsToShow.length === 0) {
                    console.warn("No items for slide:", slideIndex);
                    containerOther.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada wahana.</p>';
                    updateButtonStatesOther();
                    return;
                }

                containerOther.className = `grid grid-cols-1 sm:grid-cols-${Math.min(itemsToShow.length, 2)} lg:grid-cols-${Math.min(itemsToShow.length, itemsPerSlideOther)} gap-6 w-full max-w-5xl overflow-hidden`;


                itemsToShow.forEach((item) => {
                    
                    if (typeof item !== 'object' || item === null || !item.slug || !item.gambar || !item.nama) {
                        console.error("Invalid item data found:", item);
                        return;
                    }

                    const safeSlug = item.slug.toString().toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-').replace(/^-+/, '').replace(/-+$/, '');
                    const detailUrl = `/wahana/${safeSlug}`;
                    let imageUrl = `{{ asset('') }}${item.gambar}`;
                    imageUrl = imageUrl.replace(/([^:]\/)\/+/g, "$1");

                    containerOther.innerHTML += `
                        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200 hover:shadow-md transition-shadow h-full flex flex-col">
                            <img src="${imageUrl}" alt="${item.nama}" class="h-40 w-full object-cover">
                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div> <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-700 mb-1">${item.nama}</h4> </div>
                                <a href="${detailUrl}" class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline mt-2 self-start">Lihat Detail</a>
                            </div>
                        </div>
                    `;
                });

                updateButtonStatesOther();
            }

            function updateButtonStatesOther() {
                if (!prevBtnOther || !nextBtnOther) { console.error("Buttons not found."); return; }
                const canSlide = wahanaItemsOther.length > itemsPerSlideOther;
                prevBtnOther.disabled = !canSlide || currentSlideOther === 0;
                nextBtnOther.disabled = !canSlide || currentSlideOther >= totalSlidesOther - 1;
                console.log("Buttons updated:", { currentSlide: currentSlideOther, totalSlides: totalSlidesOther, canSlide, prevDisabled: prevBtnOther.disabled, nextDisabled: nextBtnOther.disabled });
            }

            if (nextBtnOther) {
                nextBtnOther.addEventListener('click', () => {
                    if (totalSlidesOther <= 1) return;
                    if (currentSlideOther < totalSlidesOther - 1) {
                        currentSlideOther++;
                        renderSlideOther(currentSlideOther);
                    }
                });
            } else { console.error("Button 'nextBtnOther' not found."); }

            if (prevBtnOther) {
                prevBtnOther.addEventListener('click', () => {
                    if (totalSlidesOther <= 1) return; 
                    if (currentSlideOther > 0) {
                        currentSlideOther--;
                        renderSlideOther(currentSlideOther);
                    }
                });
            } else { console.error("Button 'prevBtnOther' not found."); }

            if (containerOther && wahanaItemsOther.length > 0) {
                renderSlideOther(currentSlideOther);
            } else if (containerOther) {
                containerOther.innerHTML = '<p class="text-center text-gray-500 col-span-full">Tidak ada wahana lainnya.</p>';
              
                if(prevBtnOther) prevBtnOther.disabled = true;
                if(nextBtnOther) nextBtnOther.disabled = true;
            } else {
                console.error("Initial render failed: Container not found or no items.");
            }
        </script>
    @endif

</body>
</html>