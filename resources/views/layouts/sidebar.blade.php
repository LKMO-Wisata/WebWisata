<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

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

    {{-- Menu Navigasi (Link sudah diperbaiki) --}}
    <nav class="flex-grow">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.wahana') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200
                          {{-- Ini adalah logic untuk menandai link aktif --}}
                          {{ request()->routeIs('admin.wahana*') ? 'bg-blue-700 text-white font-semibold shadow-lg' : 'text-gray-300 hover:bg-blue-700 hover:text-white' }}">
                    <span>Atur Wahana</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.fasilitas') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200
                          {{ request()->routeIs('admin.fasilitas*') ? 'bg-blue-700 text-white font-semibold shadow-lg' : 'text-gray-300 hover:bg-blue-700 hover:text-white' }}">
                    <span>Atur Fasilitas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tiket') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg transition-colors duration-200
                          {{ request()->routeIs('admin.tiket*') ? 'bg-blue-700 text-white font-semibold shadow-lg' : 'text-gray-300 hover:bg-blue-700 hover:text-white' }}">
                    <span>Atur Tiket</span>
                </a>
            </li>
        </ul>
    </nav>

     <div class="mt-auto pt-6 border-t border-gray-700">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-3 px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition-colors">
                <svg data-lucide="log-out" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>