<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas | Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-white font-sans text-gray-900">

    @include('layouts.navbar')

    @php
        /** Normalisasi variabel yang dikirim dari controller */
        /** Controller boleh return 'fasilitasItems' (disarankan) atau 'fasilitas' (legacy) */
        $items = $fasilitasItems ?? $fasilitas ?? collect();

        /** Import helper */
        use Illuminate\Support\Str;

        /** Helper kecil untuk membangun URL gambar yang aman (hindari 403) */
        $imageUrl = function ($model) {
            // 1) Prioritaskan accessor image_url (jika ada di model)
            if (isset($model->image_url) && $model->image_url) {
                return $model->image_url;
            }

            // 2) Ambil field 'gambar' kalau ada
            $g = $model->gambar ?? null;
            if (!$g) {
                return asset('img/no-image.png');
            }

            // 3) Jika sudah full URL http/https, pakai langsung
            if (Str::startsWith($g, ['http://', 'https://'])) {
                return $g;
            }

            // 4) Jika path menunjuk ke folder public/img/... (seperti di seeder)
            //    simpan di DB sebagai 'img/fasilitas/nama-file.jpg' → akses dengan asset()
            if (Str::startsWith($g, ['img/', '/img/'])) {
                return asset(ltrim($g, '/'));
            }

            // 5) Fallback terakhir: anggap itu path storage publik (storage/app/public/..)
            //    sehingga dapat diakses via /storage/...
            return asset('storage/' . ltrim($g, '/'));
        };
    @endphp

    <section class="text-center py-16 bg-gray-50">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#001B60]">
            Kenyamanan Anda <br>
            <span class="text-[#F2C94C]">Prioritas</span> Kami
        </h1>
        <p class="mt-3 text-sm text-gray-600 max-w-xl mx-auto">
            Nikmati fasilitas yang bersih, nyaman, dan ramah keluarga di seluruh area Watersplash Park.
        </p>
    </section>

    <section class="py-16">
        <h2 class="text-center text-3xl font-bold text-[#001B60] mb-12">Fasilitas Kami</h2>

        <div class="container mx-auto px-4">
            @if($items && count($items))
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">

                    @foreach ($items as $item)
                        @php
                            $foto = $imageUrl($item);
                            // Kolom deskripsi: konsistenkan 'deskripsi' (bukan 'desc')
                            $deskripsi = $item->deskripsi ?? $item->desc ?? 'Deskripsi fasilitas belum tersedia.';
                        @endphp

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 flex flex-col w-full max-w-sm">
                            <img
                                src="{{ $foto }}"
                                alt="{{ $item->nama }}"
                                class="h-48 w-full object-cover grayscale hover:grayscale-0 transition duration-300"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='{{ asset('img/no-image.png') }}';"
                            >

                            <div class="bg-[#001B60] text-white p-4 flex-grow flex flex-col">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="bg-yellow-400 text-[#001B60] rounded-full p-1 flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                        </svg>
                                    </span>
                                    <h3 class="font-semibold text-lg text-white">{{ $item->nama }}</h3>
                                </div>

                                <p class="text-sm text-gray-200 leading-snug flex-grow">
                                    {{ $deskripsi }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Paginasi (muncul bila controller memakai paginate()) --}}
                @if (method_exists($items, 'links'))
                    <div class="mt-10">
                        {{ $items->links() }}
                    </div>
                @endif
            @else
                <div class="text-center text-gray-500 py-20">
                    Belum ada fasilitas yang dapat ditampilkan.
                </div>
            @endif
        </div>
    </section>

    @include('layouts.footer')

</body>
</html>
