<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Tiket | Dashboard Admin</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        
        {{-- Memanggil Sidebar Anda --}}
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col lg:ml-64"> {{-- Beri margin kiri seukuran sidebar di desktop --}}

            <header class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                    <button id="sidebarOpenBtn" class="lg:hidden text-gray-500 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="text-sm text-gray-500">
                        Dashboard / <span class="font-medium text-gray-800">Atur Tiket</span>
                    </div>
                    <div class="lg:hidden"></div> {{-- Spacer --}}
                </div>
            </header>

            <main class="flex-1 p-6 md:p-8">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">Atur Tiket</h1>
                    
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm" role="alert">
                            <p class="font-bold">Sukses!</p><p>{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- Konten Form Tiket --}}
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-2xl">
                        <div class="p-6 md:p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Pengaturan Harga Tiket</h3>
                            
                            <form action="{{ route('admin.tiket.update') }}" method="POST" class="space-y-6">
                                @csrf
                                
                                {{-- Harga Dewasa --}}
                                <div>
                                    <label for="harga_dewasa" class="block text-sm font-medium text-gray-700 mb-1">Harga Dewasa</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">Rp.</span>
                                        <input type="number" id="harga_dewasa" name="harga_dewasa" value="{{ $tiket['dewasa'] }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="35000">
                                    </div>
                                </div>

                                {{-- Harga Anak-Anak --}}
                                <div>
                                    <label for="harga_anak" class="block text-sm font-medium text-gray-700 mb-1">Harga Anak-Anak</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">Rp.</span>
                                        <input type="number" id="harga_anak" name="harga_anak" value="{{ $tiket['anak'] }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="30000">
                                    </div>
                                </div>

                                {{-- Biaya Fast Track --}}
                                <div>
                                    <label for="fast_track" class="block text-sm font-medium text-gray-700 mb-1">Tambahan Biaya Fast Track</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">Rp.</span>
                                        <input type="number" id="fast_track" name="fast_track" value="{{ $tiket['fast_track'] }}" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="15000">
                                    </div>
                                </div>
                                
                                <div class="pt-4 flex justify-end">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-200">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Akhir Konten Form Tiket --}}

                </div>
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
        // Script untuk toggle sidebar mobile
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const openBtn = document.getElementById('sidebarOpenBtn');
        const closeBtn = document.getElementById('sidebarCloseBtn');
        function openSidebar() { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); }
        function closeSidebar() { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); }
        if (openBtn) openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);
    </script>
</body>
</html>