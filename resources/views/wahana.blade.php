<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wahana Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png"> 
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: Tambahkan font kustom jika perlu */
    </style>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @php
                 
                $wahanaItems = [
                    ['nama' => 'Bumper Cars',       'gambar' => 'img/wahana/wahana1.jpeg','slug' => 'Bumper Cars'], 
                    ['nama' => 'Drop Tower',       'gambar' => 'img/wahana/wahana2.jpeg','slug' => 'Drop Tower'],
                    ['nama' => 'Fantasy Voyage',   'gambar' => 'img/wahana/wahana3.jpeg','slug' => 'Fantasy Voyage'],
                    ['nama' => 'Mini Bumper Blast','gambar' => 'img/wahana/wahana4.jpeg','slug' => 'Mini Bumper Blast'], 
                    ['nama' => 'Mini Glowtopus Spin',   'gambar' => 'img/wahana/wahana5.jpeg','slug' => 'Mini Glowtopus Spin'], 
                    ['nama' => 'Pirate Ship','gambar' => 'img/wahana/wahana6.jpeg','slug' => 'Pirate Ship'], 
                    ['nama' => 'Rapid River Splash',   'gambar' => 'img/wahana/wahana7.jpeg','slug' => 'Rapid River Splash'],
                    ['nama' => 'Rush Rider',       'gambar' => 'img/wahana/wahana8.jpeg','slug' => 'Rush Rider'],
                    ['nama' => 'Sky Wheel',        'gambar' => 'img/wahana/wahana9.jpeg','slug' => 'Sky Wheel'],
                    ['nama' => 'Swan Lake Paddle',     'gambar' => 'img/wahana/wahana10.jpeg','slug' => 'Swan Lake Paddle'],
                    ['nama' => 'Trampland',       'gambar' => 'img/wahana/wahana11.jpeg','slug' => 'Trampland'],
                    ['nama' => 'Twinkle Carousel','gambar' => 'img/wahana/wahana12.jpeg','slug' => 'Twinkle Carousel'],
                    
                ];
            @endphp


            @foreach ($wahanaItems as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" class="h-60 w-full object-cover"> 
                <div class="bg-sky-100 p-4"> 
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-800 mb-1">{{ $item['nama'] }}</h3>
            
            
                    <a href="{{ route('wahana.detail', ['slug' => $item['slug']]) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    @include('layouts.footer')

</body>
</html>