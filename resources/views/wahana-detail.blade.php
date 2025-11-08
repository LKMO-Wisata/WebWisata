<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wahanaDetail->nama }} | Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-white font-sans text-gray-900">

    @include('layouts.navbar')

    {{-- HERO --}}
    @php
        $heroUrl   = $wahanaDetail->primary_photo_url ?? asset('img/no-image.png');
        $allPhotos = $wahanaDetail->photo_urls ?? [];
    @endphp
    <div id="wahanaHeroBanner"
         class="relative h-[60vh] md:h-[70vh] bg-cover bg-center transition-all duration-300 {{ count($allPhotos) > 1 ? 'cursor-pointer' : '' }}"
         style="background-image: url('{{ $heroUrl }}');">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10 bg-gradient-to-t from-black via-black/70 to-transparent">
            <h1 class="text-3xl md:text-5xl font-bold text-white text-center uppercase tracking-wider">
                {{ $wahanaDetail->nama }}
            </h1>
        </div>
    </div>

    {{-- KONTEN --}}
    <section class="container mx-auto px-4 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">

            {{-- Sidebar Ketentuan --}}
            <aside class="md:col-span-1 space-y-6">
                <h2 class="text-xl font-semibold text-[#001B60] border-b pb-2">Ketentuan :</h2>
                <ul class="space-y-2 text-sm text-gray-700">
                    @if(is_array($wahanaDetail->ketentuan) && count($wahanaDetail->ketentuan))
                        @foreach ($wahanaDetail->ketentuan as $k)
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

                <a href="{{ url('/tiket') }}"
                   class="inline-block w-full text-center bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-blue-700 transition duration-300">
                    Beli Tiket Sekarang
                </a>
            </aside>

            {{-- Deskripsi --}}
            <article class="md:col-span-2">
                <h2 class="text-2xl font-bold text-[#001B60] mb-4">{{ $wahanaDetail->nama }}</h2>
                <p class="text-gray-600 leading-relaxed text-justify">
                    {{ $wahanaDetail->deskripsi ?? 'Deskripsi wahana belum tersedia.' }}
                </p>

                {{-- (Opsional) Galeri foto kecil --}}
                @if(count($allPhotos) > 1)
                    <div class="mt-8 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                        @foreach($allPhotos as $url)
                            <button type="button"
                                    class="block rounded overflow-hidden border border-gray-200 hover:ring-2 hover:ring-blue-400 transition"
                                    onclick="swapHero(@js($url))">
                                <img src="{{ $url }}" alt="Foto {{ $wahanaDetail->nama }}"
                                     class="w-full h-20 object-cover"
                                     loading="lazy"
                                     onerror="this.onerror=null;this.src='{{ asset('img/no-image.png') }}';">
                            </button>
                        @endforeach
                    </div>
                @endif
            </article>

        </div>
    </section>

    {{-- Wahana Lainnya --}}
    @php
        // Build data slider: nama, url detail, foto utama (fallback aman)
        $sliderItems = collect($otherWahana ?? [])
            ->map(function($w) {
                return [
                    'nama' => $w->nama,
                    'url'  => route('wahana.detail', $w->slug),
                    'foto' => $w->primary_photo_url ?? asset('img/no-image.png'),
                ];
            })
            ->values()
            ->all();
    @endphp

    @if(!empty($sliderItems))
        <section class="py-16 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-2xl font-bold text-[#001B60] text-center mb-12">
                    Jelajahi Wahana Lainnya
                </h2>
                <div class="flex justify-center items-center space-x-4">
                    <button id="prevBtnOther"
                            class="p-2 rounded-full bg-white shadow-md text-gray-600 hover:bg-gray-100 hover:text-indigo-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <div id="wahanaContainerOther"
                         class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full max-w-5xl overflow-hidden">
                        <div class="text-center text-gray-500 py-10 col-span-full" id="loadingPlaceholder">
                            Memuat wahana...
                        </div>
                    </div>

                    <button id="nextBtnOther"
                            class="p-2 rounded-full bg-white shadow-md text-gray-600 hover:bg-gray-100 hover:text-indigo-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    @else
        <section class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold text-center text-[#001B60] mb-10">Jelajahi Wahana Lainnya</h2>
                <p class="text-center text-gray-500">Belum ada rekomendasi lainnya.</p>
            </div>
        </section>
    @endif

    @include('layouts.footer')

    {{-- Scripts --}}
    <script>
        // ===== Hero swap (klik hero / klik thumbnail) =====
        const heroBanner = document.getElementById('wahanaHeroBanner');
        const photoList  = @json($allPhotos);
        let heroIndex = 0;

        function setHero(url) {
            if (heroBanner) {
                heroBanner.style.backgroundImage = `url('${url}')`;
            }
        }

        function swapHero(url) {
            setHero(url);
            const idx = photoList.indexOf(url);
            heroIndex = idx >= 0 ? idx : heroIndex;
        }

        if (heroBanner && Array.isArray(photoList) && photoList.length > 1) {
            heroBanner.addEventListener('click', () => {
                heroIndex = (heroIndex + 1) % photoList.length;
                setHero(photoList[heroIndex]);
            });
        }

        // ===== Slider "Wahana Lainnya" (loop & tombol selalu aktif jika ada >1 item) =====
        @if(!empty($sliderItems))
        (function(){
            const original = @json($sliderItems);
            const per = 3; // tampilkan 3 kartu per "halaman"

            // Jika item terlalu sedikit, gandakan supaya tetap bisa geser
            let items = [...original];
            if (items.length > 1 && items.length <= per) {
                items = items.concat(original);
            }

            const container = document.getElementById('wahanaContainerOther');
            const prevBtn   = document.getElementById('prevBtnOther');
            const nextBtn   = document.getElementById('nextBtnOther');
            const loading   = document.getElementById('loadingPlaceholder');

            // Minimal 1 halaman
            let total = Math.max(1, Math.ceil(items.length / per));
            let current = 0;

            function renderSlide(idx){
                if (!container) return;
                if (loading) loading.remove();
                container.innerHTML = '';

                const start = (idx * per) % items.length;
                // Ambil subset aman (membungkus)
                const subset = [];
                for (let i = 0; i < per; i++) {
                    subset.push(items[(start + i) % items.length]);
                }

                subset.forEach(it => {
                    const foto = it.foto || "{{ asset('img/no-image.png') }}";
                    const nama = it.nama || 'Wahana';
                    const url  = it.url || '#';

                    const card = `
                        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200 hover:shadow-md transition-shadow h-full flex flex-col">
                            <img src="${foto}" alt="${nama}" class="w-full h-44 object-cover"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='{{ asset('img/no-image.png') }}';">
                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <div>
                                  <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-700 mb-1">${nama}</h4>
                                </div>
                                <a href="${url}"
                                   class="text-xs font-medium text-blue-600 hover:text-blue-800 hover:underline mt-2 self-start">
                                   Lihat Detail
                                </a>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', card);
                });

                updateNav();
            }

            function updateNav(){
                const canSlide = items.length > 1;
                // Jangan disable tombol jika ada >1 item, biar tetap bisa loop
                prevBtn?.classList.toggle('opacity-40', !canSlide);
                nextBtn?.classList.toggle('opacity-40', !canSlide);
            }

            prevBtn?.addEventListener('click', () => {
                if (items.length <= 1) return;
                current = (current - 1 + total) % total;
                renderSlide(current);
            });

            nextBtn?.addEventListener('click', () => {
                if (items.length <= 1) return;
                current = (current + 1) % total;
                renderSlide(current);
            });

            // Init
            renderSlide(current);
        })();
        @endif
    </script>

</body>
</html>
