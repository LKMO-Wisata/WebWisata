{{-- 
  File: resources/views/layouts/sidebar.blade.php
  - Sidebar Admin
  - TANPA "Tambah Wahana" → sudah ada di awahana.blade.php
  - Semua route terhubung
  - Highlight aktif otomatis
--}}

<div id="sidebar" class="w-64 h-screen bg-[#0d1741] text-white p-6 flex flex-col fixed top-0 left-0 z-50
                      transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0">

    <!-- Header + Close Button (Mobile) -->
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-2xl font-bold text-gray-100">Dashboard Admin</h1>
        <button id="sidebarCloseBtn" class="lg:hidden text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigasi -->
    <nav class="flex-grow">
        <ul class="space-y-2">

            <!-- ATUR WAHANA -->
            <li>
                <a href="{{ route('admin.wahana') }}"
                   class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200
                          {{ request()->is('admin/wahana') && !request()->is('admin/wahana/*') 
                             ? 'bg-blue-700 text-white font-semibold shadow-lg' 
                             : 'text-gray-300 hover:bg-blue-700 hover:text-white' }}">
                    <span>Atur Wahana</span>
                </a>
            </li>

            <!-- EDIT WAHANA (hanya muncul saat di halaman edit) -->
            @if(request()->is('admin/wahana/edit/*'))
                <li>
                    <a href="{{ url()->current() }}"
                       class="flex items-center px-4 py-2.5 rounded-lg bg-blue-700 text-white font-semibold shadow-lg">
                        <span>Edit Wahana</span>
                    </a>
                </li>
            @endif

            <!-- ATUR FASILITAS -->
            <li>
                <a href="{{ route('admin.fasilitas') }}"
                   class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200
                          {{ request()->is('admin/fasilitas*') 
                             ? 'bg-blue-700 text-white font-semibold shadow-lg' 
                             : 'text-gray-300 hover:bg-blue-700 hover:text-white' }}">
                    <span>Atur Fasilitas</span>
                </a>
            </li>

            <!-- ATUR TIKET -->
            <li>
                <a href="{{ route('admin.tiket') }}"
                   class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200
                          {{ request()->is('admin/tiket*') 
                             ? 'bg-blue-700 text-white font-semibold shadow-lg' 
                             : 'text-gray-300 hover:bg-blue-700 hover:text-white' }}">
                    <span>Atur Tiket</span>
                </a>
            </li>

        </ul>
    </nav>

    <!-- Logout -->
    <div class="mt-auto pt-6 border-t border-gray-700">
        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
            @csrf
            <button type="submit" 
                    class="flex items-center w-full px-4 py-2.5 rounded-lg text-gray-300 hover:bg-red-900 hover:text-white transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>