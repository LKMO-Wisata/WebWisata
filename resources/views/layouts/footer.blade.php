<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-[#000B58] text-[#FDEB9E] py-14">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 px-6">
        <!-- Kolom 1: Logo & Kontak -->
        <div>
            <h3 class="text-[#FDEB9E] font-bold text-3xl mb-6">Watersplash Park</h3>

            <div class="flex items-start gap-4 mb-4">
                <div class="bg-[#FDEB9E] text-[#000B58] p-3 rounded-2xl">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <h4 class="font-semibold">Alamat</h4>
                    <p class="text-sm text-blue-200">Jalan Terusan Ryacudu 35365 Jati Agung, Lampung</p>
                </div>
            </div>

            <div class="flex items-start gap-4 mb-4">
                <div class="bg-[#FDEB9E] text-[#000B58] p-3 rounded-2xl">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div>
                    <h4 class="font-semibold">Telepon</h4>
                    <p class="text-sm text-blue-200">+62 812-3456-7890</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="bg-[#FDEB9E] text-[#000B58] p-3 rounded-2xl">
                    <i class="fa-brands fa-instagram"></i>
                </div>
                <div>
                    <h4 class="font-semibold">Instagram</h4>
                    <p class="text-sm text-blue-200">@watersplash</p>
                </div>
            </div>
        </div>

        <!-- Kolom 2: Beranda -->
        <div>
            <h4 class="text-[#FDEB9E] font-semibold text-lg mb-4">Beranda</h4>
            <ul class="space-y-2">
                <li><a href="{{ url('/') }}" class="hover:text-red-500">Tentang kami</a></li>

            </ul>
        </div>

       {{-- Kolom 3: Wahana (DIPERBARUI) --}}
        <div>
            <h4 class="text-lg font-semibold mb-4">Wahana</h4>
            
            {{-- ✅ Definisikan data wahana (nama & slug) di sini --}}
            @php
                $footerWahana = [
                    ['nama' => 'Bumper Cars',       'slug' => 'Bumper Cars'], 
                    ['nama' => 'Drop Tower',       'slug' => 'Drop Tower'],
                    ['nama' => 'Fantasy Voyage',   'slug' => 'Fantasy Voyage'],
                    ['nama' => 'Mini Bumper Blast','slug' => 'Mini Bumper Blast'], 
                    ['nama' => 'Mini Glowtopus Spin','slug' => 'Mini Glowtopus Spin'], 
                    ['nama' => 'Pirate Ship',      'slug' => 'Pirate Ship'], 
                    ['nama' => 'Rapid River Splash','slug' => 'Rapid River Splash'],
                    ['nama' => 'Rush Rider',       'slug' => 'Rush Rider'],
                    ['nama' => 'Sky Wheel',        'slug' => 'Sky Wheel'],
                    ['nama' => 'Swan Lake Paddle', 'slug' => 'Swan Lake Paddle'],
                    ['nama' => 'Trampland',        'slug' => 'Trampland'],
                    ['nama' => 'Twinkle Carousel', 'slug' => 'Twinkle Carousel'], 
                ];
            @endphp
            
            {{-- ✅ Loop untuk membuat link dinamis --}}
            <ul class="space-y-2 text-sm">
                @foreach ($footerWahana as $item)
                    <li>
                        <a href="{{ route('wahana.detail', ['slug' => $item['slug']]) }}" class="hover:text-yellow-400 transition-colors">
                            {{ $item['nama'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Kolom 4: Fasilitas -->
        <div>
            <h4 class="text-[#FDEB9E] font-semibold text-lg mb-4">Fasilitas</h4>
            <ul class="space-y-2">
                <li><a href="{{ url('/fasilitas')}}" class="hover:text-red-500">Food Court</a></li>
                <li><a href="{{ url('/fasilitas')}}" class="hover:text-red-500">Gazebo</a></li>
                <li><a href="{{ url('/fasilitas')}}" class="hover:text-red-500">Mushola</a></li>
                <li><a href="{{ url('/fasilitas')}}" class="hover:text-red-500">Parking Lot</a></li>
                <li><a href="{{ url('/fasilitas')}}" class="hover:text-red-500">Toilet</a></li>

            </ul>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-blue-800 mt-12 pt-6">
        <p class="text-right text-sm text-blue-300 pr-6">
            © 2025 LKMO Kelompok 6 Wisata
        </p>
    </div>
</footer>
