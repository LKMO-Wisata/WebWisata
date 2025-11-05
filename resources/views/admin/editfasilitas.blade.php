<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fasilitas | Dashboard Admin</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style> 
        body { font-family: 'Poppins', sans-serif; } 
        /* Menyembunyikan panah atas/bawah di input number */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col lg:ml-64">
            
            <header class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-30">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                    <button id="sidebarOpenBtn" class="lg:hidden text-gray-500 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="text-sm text-gray-500">
                        Dashboard / <a href="{{ route('admin.fasilitas') }}" class="hover:underline">Atur Fasilitas</a> / <span class="font-medium text-gray-800">Edit Fasilitas</span>
                    </div>
                    <div class="lg:hidden"></div>
                </div>
            </header>

            <main class="flex-1 p-6 md:p-8">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Fasilitas</h1>
                    
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm" role="alert">
                            <p class="font-bold">Sukses!</p><p>{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- 
                      Form ini akan mengirim data ke route 'admin.fasilitas.update'
                      Data $fasilitas didapat dari route 'admin.fasilitas.edit'
                    --}}
                    <form action="{{ route('admin.fasilitas.update', ['slug' => $fasilitas['slug']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div class="md:col-span-1">
                                <div class="bg-white rounded-xl shadow-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Fasilitas</h3>
                                    
                                    {{-- Menampilkan gambar saat ini --}}
                                    <img src="{{ asset('img/fasilitas/' . $fasilitas['gambar']) }}" alt="{{ $fasilitas['nama'] }}" class="w-full h-48 object-cover rounded-lg shadow-inner border border-gray-200 mb-4">
                                    
                                    <label for="foto_fasilitas" class="w-full text-center cursor-pointer bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                                        Ganti Foto
                                    </label>
                                    <input type="file" name="foto_fasilitas" id="foto_fasilitas" class="hidden">
                                    
                                    <p class="text-xs text-gray-500 mt-2">Kosongkan jika tidak ingin mengganti foto.</p>
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <div class="bg-white rounded-xl shadow-lg p-6">
                                    <div class="space-y-6">
                                        
                                        <div>
                                            <label for="nama_fasilitas" class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                                            <input type_text" id="nama_fasilitas" name="nama_fasilitas" 
                                                   value="{{ $fasilitas['nama'] }}" 
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                        </div>

                                        <div>
                                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Fasilitas</label>
                                            <textarea id="deskripsi" name="deskripsi" rows="6" 
                                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ $fasilitas['desc'] }}</textarea>
                                        </div>
                                        
                                        <div class="flex justify-end pt-4">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-colors duration-200">
                                                Simpan Perubahan
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