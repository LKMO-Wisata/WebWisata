<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Atur Tiket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
</head>
<body class="bg-gray-100">

    <!-- Hamburger Button -->
    <button id="hamburgerBtn" class="fixed top-4 left-4 z-40 p-2 bg-gray-800 text-white rounded-md lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <div class="flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-4 md:p-8 lg:ml-64 transition-all duration-300">
            
            <!-- Breadcrumb -->
            <div class="text-sm text-gray-500 mb-4 hidden md:block">
                Dashboard / <span class="font-semibold text-gray-700">Atur Tiket</span>
            </div>

            <!-- Success Message (Simulasi) -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Card Form — SAMA PERSIS FOTO -->
            <div class="bg-white shadow-xl rounded-lg p-6 max-w-4xl mx-auto border">
                <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Atur Konten Halaman Tiket</h3>

                <form action="#" method="POST" class="space-y-6">
                    @csrf

                    <!-- 1. Judul Halaman -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Halaman</label>
                            <input type="text" value="Tiket" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sub Judul</label>
                            <input type="text" value="Beli tiket disini" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- 2. Ketentuan Umum -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ketentuan Umum (satu per baris)</label>
                        <textarea rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 resize-none">
Dewasa: 19th keatas
Anak-Anak: 2-18th
Dibawah 2th tidak dikenakan biaya tiket masuk
                        </textarea>
                    </div>

                    <!-- 3. Label Tanggal Kedatangan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Label Tanggal Kedatangan</label>
                        <input type="text" value="Tanggal Kedatangan" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- 4. Teks "Tiket untuk tanggal..." — DIPERBAIKI -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teks Dinamis Tanggal</label>
                        <input type="text" 
                               value="Tiket untuk tanggal &#123;&#123; tanggal &#125;&#125;:" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">
                            Gunakan <code>&#123;&#123; tanggal &#125;&#125;</code> untuk tanggal otomatis
                        </p>
                    </div>

                    <!-- 5. Card Tiket Dewasa -->
                    <div class="bg-blue-50 p-5 rounded-lg border">
                        <h4 class="font-semibold text-blue-900 mb-3">Card Tiket Dewasa</h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Card</label>
                                <input type="text" value="Tiket Masuk Watersplash Park" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Label Kategori</label>
                                <input type="text" value="Dewasa" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3 text-gray-500 text-sm">Rp</span>
                                    <input type="number" value="35000" min="0" step="1000" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fast Track</label>
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" checked class="rounded">
                                    <input type="text" value="Fast Track (+ Rp 15.000)" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tombol</label>
                                <input type="text" value="Tambah" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                        </div>
                    </div>

                    <!-- 6. Card Tiket Anak -->
                    <div class="bg-green-50 p-5 rounded-lg border">
                        <h4 class="font-semibold text-green-900 mb-3">Card Tiket Anak-Anak</h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Card</label>
                                <input type="text" value="Tiket Masuk Watersplash Park" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Label Kategori</label>
                                <input type="text" value="Anak-Anak" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-3 text-gray-500 text-sm">Rp</span>
                                    <input type="number" value="30000" min="0" step="1000" class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Fast Track</label>
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" checked class="rounded">
                                    <input type="text" value="Fast Track (+ Rp 15.000)" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tombol</label>
                                <input type="text" value="Tambah" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                        </div>
                    </div>

                    <!-- 7. Keranjang Belanja -->
                    <div class="bg-gray-50 p-5 rounded-lg border">
                        <h4 class="font-semibold text-gray-900 mb-3">Keranjang Belanja</h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Keranjang</label>
                                <input type="text" value="Keranjang Belanja" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Teks Tanggal di Keranjang</label>
                                <input type="text" value="Tanggal Kedatangan: 5 November 2025" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Teks Kosong</label>
                                <input type="text" value="Keranjang Anda kosong." class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tombol Lanjut</label>
                                <input type="text" value="Lanjut ke Pembayaran" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Button Simpan -->
                    <div class="flex justify-end pt-6">
                        <button type="submit" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-lg transition shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- JavaScript Sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
            const overlay = document.getElementById('sidebarOverlay');

            const toggleSidebar = () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            };

            hamburgerBtn?.addEventListener('click', toggleSidebar);
            sidebarCloseBtn?.addEventListener('click', toggleSidebar);
            overlay?.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>