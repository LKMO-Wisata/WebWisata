<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wahana Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
</head>
<body class="bg-gray-100">

    <button id="hamburgerBtn" class="fixed top-4 left-4 z-40 p-2 bg-gray-800 text-white rounded-md lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <div class="flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-4 md:p-8 lg:ml-64 transition-all duration-300">

            <div class="text-sm text-gray-500 mb-4 mt-12 lg:mt-0">
                <a href="{{ route('admin.wahana') }}" class="hover:underline">Dashboard</a> /
                <a href="{{ route('admin.wahana') }}" class="hover:underline">Atur Wahana</a> /
                <span class="font-semibold text-gray-700">Tambah Wahana</span>
            </div>

            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-6">Tambah Wahana Baru</h2>

            {{-- Form ini mengirim ke route 'admin.wahana.store' --}}
            <form action="{{ route('admin.wahana.store') }}" method="POST" enctype="multipart/form-data">
                @csrf 

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">
                    
                    <div class="lg:col-span-1">
                        <div class="bg-white p-4 md:p-6 rounded-lg shadow-xl">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Wahana</label>
                            
                            {{-- Placeholder untuk gambar --}}
                            <div id="imagePreview" class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 mb-4">
                                Preview Foto
                            </div>
                            
                            <label for="foto_wahana" class="cursor-pointer w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 block">
                                Pilih Foto
                            </label>
                            <input type="file" name="foto_wahana" id="foto_wahana" class="hidden" required>
                            <p class="text-xs text-gray-500 mt-2">Foto wajib diisi.</p>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="bg-white p-4 md:p-6 rounded-lg shadow-xl space-y-6">
                            
                            <div>
                                <label for="nama_wahana" class="block text-sm font-medium text-gray-700">Nama Wahana</label>
                                <input type="text" name="nama_wahana" id="nama_wahana" 
                                       value="" placeholder="Contoh: Bumper Cars" 
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>

                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Wahana</label>
                                <textarea name="deskripsi" id="deskripsi" rows="8" 
                                          placeholder="Deskripsi singkat wahana..."
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
                            </div>

                            <div>
                                <label for="ketentuan" class="block text-sm font-medium text-gray-700">Syarat dan Ketentuan</label>
                                <p class="text-xs text-gray-500 mb-1">Masukkan satu ketentuan per baris.</p>
                                <textarea name="ketentuan" id="ketentuan" rows="8" 
                                          placeholder="Contoh: Usia: minimal 15 tahun&#10;Tinggi badan: Minimal 130 cm"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0d1741] hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Simpan Wahana Baru
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
            
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Script Sidebar ---
            const sidebar = document.getElementById('sidebar');
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            const toggleSidebar = () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            };

            if (hamburgerBtn) hamburgerBtn.addEventListener('click', toggleSidebar);
            if (sidebarCloseBtn) sidebarCloseBtn.addEventListener('click', toggleSidebar);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

            // --- Script Preview Foto ---
            const fileInput = document.getElementById('foto_wahana');
            const fileLabel = document.querySelector('label[for="foto_wahana"]');
            const imagePreview = document.getElementById('imagePreview');

            if(fileInput && fileLabel && imagePreview) {
                fileInput.addEventListener('change', () => {
                    if (fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        fileLabel.textContent = file.name;
                        
                        // Tampilkan preview gambar
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        fileLabel.textContent = 'Pilih Foto';
                        imagePreview.innerHTML = 'Preview Foto';
                    }
                });
            }
        });
    </script>

</body>
</html>