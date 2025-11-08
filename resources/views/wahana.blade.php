<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wahana Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Tambahan agar ikon tampil --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>
</head>
<body class="bg-gray-50 font-sans text-gray-900">

    @include('layouts.navbar')

    <section class="text-center py-16 px-4">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#001B60] mb-3">
            Jelajahi Semua Wahana <br> Wondersplash Park
        </h1>
        <p class="text-sm text-gray-500 max-w-xl mx-auto leading-relaxed">
            Temukan keseruan tanpa batas di setiap sudutnya, dan rasakan pengalaman tak terlupakan di Wondersplash Park!
        </p>
    </section>

    <section class="container mx-auto px-4 pb-16">
        @if(isset($wahanaItems) && count($wahanaItems))
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($wahanaItems as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        {{-- Foto utama dengan fallback --}}
                        <img
                            src="{{ $item->primary_photo_url ?? asset('img/no-image.png') }}"
                            alt="{{ $item->nama }}"
                            class="h-60 w-full object-cover"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='{{ asset('img/no-image.png') }}';"
                        >
                        <div class="bg-sky-100 p-4">
                            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-800 mb-1">
                                {{ $item->nama }}
                            </h3>

                            <a href="{{ route('wahana.detail', $item->slug) }}"
                               class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">
                                Lihat Detail
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Paginasi jika menggunakan paginate() di controller --}}
            @if(method_exists($wahanaItems, 'links'))
                <div class="mt-10">
                    {{ $wahanaItems->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-20 text-gray-500">
                Belum ada wahana yang dapat ditampilkan.
            </div>
        @endif
    </section>

    @include('layouts.footer')

    {{-- Inisialisasi ikon Lucide setelah DOM siap --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide && typeof window.lucide.createIcons === 'function') {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
