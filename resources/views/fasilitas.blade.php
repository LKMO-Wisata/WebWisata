<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas | Watersplash Park</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png"> <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans text-gray-900">

    @include('layouts.navbar')

    {{-- ===== Judul ===== --}}
    <section class="text-center py-16 bg-gray-50">
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#001B60]">
            Kenyamanan Anda <br>
            <span class="text-[#F2C94C]">Prioritas</span> Kami
        </h1>
    </section>

    {{-- ===== Section Fasilitas Utama ===== --}}
    <section class="py-16">
        <h2 class="text-center text-3xl font-bold text-[#001B60] mb-12">Fasilitas Kami</h2>

        @php
            
            $fasilitas = [
                ['nama' => 'Musholah',    'desc' => 'Fasilitas tempat ibadah yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Mushollah.jpg'],
                ['nama' => 'Parking Lot', 'desc' => 'Fasilitas tempat parkir yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Parking Lot.jpg'],
                ['nama' => 'Gazebo',      'desc' => 'Fasilitas gazebo yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Gazebo.jpg'],
                ['nama' => 'Food Court',  'desc' => 'Fasilitas food court yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Food Court.jpg'],
                ['nama' => 'Toilet',      'desc' => 'Fasilitas toilet dan locker yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Toilet.jpg'],
            ];
        @endphp

        
        <div class="container mx-auto px-4">
           
             <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center"> 
            
                @foreach ($fasilitas as $item)
                    
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 flex flex-col w-full max-w-sm"> 
                        
                        <img src="{{ asset('img/fasilitas/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="h-48 w-full object-cover grayscale hover:grayscale-0 transition duration-300"> 
                        
                      
                        <div class="bg-[#001B60] text-white p-4 flex-grow flex flex-col"> 
                             <div class="flex items-center space-x-2 mb-2">
                                <span class="bg-yellow-400 text-[#001B60] rounded-full p-1 flex-shrink-0"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.719c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.07-3.292z"/>
                                    </svg>
                                </span>
                                <h3 class="font-semibold text-lg text-white">{{ $item['nama'] }}</h3> 
                            </div>
                            <p class="text-sm text-gray-200 leading-snug flex-grow">{{ $item['desc'] }}</p> 
                        </div>
                    </div>
                @endforeach
            </div> </div> </section> 
            
            @include('layouts.footer') 

</body>
</html>