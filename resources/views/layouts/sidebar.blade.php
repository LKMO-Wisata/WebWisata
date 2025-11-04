{{-- 
  File ini HANYA berisi kode untuk sidebar.
  - Diberi ID 'sidebar' agar bisa dikontrol JavaScript.
  - 'fixed z-50' agar selalu di atas.
  - '-translate-x-full' (tersembunyi) di HP, 'lg:translate-x-0' (terlihat) di Desktop.
--}}
<div id="sidebar" class="w-64 h-screen bg-[#0d1741] text-white p-6 flex flex-col fixed top-0 left-0 z-50
                      transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0">
    
    {{-- Header Sidebar dengan Tombol Close (X) untuk Mobile --}}
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-2xl font-bold text-gray-100">
            Dashboard Admin
        </h1>
        {{-- Tombol 'X' untuk menutup, hanya terlihat di HP (lg:hidden) --}}
        <button id="sidebarCloseBtn" class="lg:hidden text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    {{-- Menu Navigasi (tidak berubah) --}}
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

