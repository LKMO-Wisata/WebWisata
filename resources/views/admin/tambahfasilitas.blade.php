<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Fasilitas | Dashboard Admin</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Import Alpine.js untuk preview foto --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style> 
        body { font-family: 'Poppins', sans-serif; } 
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        
        {{-- Memanggil Sidebar Anda (pastikan path-nya benar) --}}
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col lg:ml-64">
            
            <header class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                    <button id="sidebarOpenBtn" class="lg:hidden text-gray-500 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="text-sm text-gray-500">
                        Dashboard / <a href="{{ route('admin.fasilitas') }}" class="hover:underline">Atur Fasilitas</a> / <span class="font-medium text-gray-800">Tambah Fasilitas</span>
                    </div>
                    <div class="lg:hidden"></div>
                </div>
            </header>

            <main class="flex-1 p-6 md:p-8">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Fasilitas Baru</h1>
                    
                    {{-- Form ini akan mengirim data ke route 'admin.fasilitas.store' --}}
                    <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div class="md:col-span-1" x-data="{ photoPreview: null }">
                                <div class="bg-white rounded-xl shadow-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Fasilitas</h3>
                                    
                                    <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 shadow-inner border border-gray-200 mb-4">
                                        <template x-if="!photoPreview">
                                            <span>Preview Foto</span>
                                        </template>
                                        <template x-if="photoPreview">
                                            <img :src="photoPreview" alt="Preview" class="w-full h-full object-cover rounded-lg">
                                        </template>
                                    </div>
                                    
                                    <label for="foto_fasilitas" class="w-full text-center cursor-pointer bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                                        Pilih Foto
                                    </label>
                                    <input type="file" name="foto_fasilitas" id="foto_fasilitas" class="hidden" 
                                           @change="photoPreview = URL.createObjectURL($event.target.files[0])" 
                                           required>
                                    
                                    <p class="text-xs text-gray-500 mt-2">Foto wajib diisi.</p>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <div class="bg-white rounded-xl shadow-lg p-6">
                                    <div class="space-y-6">
                                        
                                        <div>
                                            <label for="nama_fasilitas" class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                                            <input type="text" id="nama_fasilitas" name="nama_fasilitas" 
                                                   placeholder="Contoh: Gazebo"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                        </div>

                                        <div>
                                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Fasilitas</label>
                                            <textarea id="deskripsi" name="deskripsi" rows="8" 
                                                      placeholder="Deskripsi singkat fasilitas..."
                                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                                        </div>
                                        
                                        <div class="flex justify-end pt-4">
                                            <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-200">
                                                Simpan Fasilitas Baru
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

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