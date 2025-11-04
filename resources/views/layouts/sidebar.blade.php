{{-- 
  File ini HANYA berisi kode untuk sidebar.
  Warnanya saya samakan dengan desain Anda (biru tua pekat).
--}}
<div class="w-64 h-screen bg-[#0d1741] text-white p-6 flex flex-col fixed top-0 left-0">
    {{-- Judul Dashboard --}}
    <h1 class="text-2xl font-bold mb-10 text-gray-100">
        Dashboard Admin
    </h1>
    
    {{-- Menu Navigasi --}}
    <nav class="flex-grow">
        <ul>
            <li>
                {{-- Tautan Aktif: Sesuai halaman saat ini --}}
                <a href="{{ route('admin.wahana') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg bg-blue-700 text-white font-semibold shadow-lg">
                    <span>Atur Wahana</span>
                </a>
            </li>
            <li class="mt-2">
                {{-- Tautan Tidak Aktif: Contoh --}}
                <a href="#" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-gray-300 hover:bg-blue-700 hover:text-white transition-colors duration-200">
                    <span>Atur Fasilitas</span>
                </a>
            </li>
            <li class="mt-2">
                {{-- Tautan Tidak Aktif: Contoh --}}
                <a href="#" 
                   class="flex items-center px-4 py-2.5 rounded-lg text-gray-300 hover:bg-blue-700 hover:text-white transition-colors duration-200">
                    <span>Atur Tiket</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
