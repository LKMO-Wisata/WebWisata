<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Fasilitas | Dashboard Admin</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-100">
<div class="flex min-h-screen">
    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col lg:ml-64">

        <header class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
                <button id="sidebarOpenBtn" class="lg:hidden text-gray-500 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="text-sm text-gray-500">
                    Dashboard / <a href="{{ route('admin.fasilitas.index') }}" class="hover:underline">Atur Fasilitas</a> / <span class="font-medium text-gray-800">Tambah Fasilitas</span>
                </div>
                <div class="lg:hidden"></div>
            </div>
        </header>

        <main class="flex-1 p-6 md:p-8">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Fasilitas Baru</h1>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-sm">
                        <p class="font-bold mb-1">Validasi gagal:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div class="md:col-span-1" x-data="{ photoPreview: null }">
                            <div class="bg-white rounded-xl shadow-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto Fasilitas</h3>

                                <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 shadow-inner border border-gray-200 mb-4">
                                    <template x-if="!photoPreview"><span>Preview Foto</span></template>
                                    <template x-if="photoPreview"><img :src="photoPreview" alt="Preview" class="w-full h-full object-cover rounded-lg"></template>
                                </div>

                                <label for="gambar" class="w-full text-center cursor-pointer bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded-lg shadow-sm hover:bg-gray-50 transition-colors">
                                    Pilih Foto
                                </label>
                                <input type="file" name="gambar" id="gambar" class="hidden"
                                       @change="photoPreview = URL.createObjectURL($event.target.files[0])"
                                       accept="image/*">
                                <p class="text-xs text-gray-500 mt-2">Format: jpg, jpeg, png, webp. Maks 2MB. Layout: 16:9</p>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <div class="bg-white rounded-xl shadow-lg p-6">
                                <div class="space-y-6">
                                    <div>
                                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Fasilitas</label>
                                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                               placeholder="Contoh: Gazebo"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    </div>

                                    <div>
                                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (opsional)</label>
                                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                               placeholder="Contoh: gazebo"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <p class="text-xs text-gray-400 mt-1">Kosongkan untuk generate otomatis dari nama.</p>
                                    </div>

                                    <div>
                                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                        <textarea id="deskripsi" name="deskripsi" rows="8" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('deskripsi') }}</textarea>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <input id="is_active" name="is_active" type="checkbox" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded" checked>
                                        <label for="is_active" class="text-sm text-gray-700">Aktif</label>
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
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const openBtn = document.getElementById('sidebarOpenBtn');
    const closeBtn = document.getElementById('sidebarCloseBtn');
    function openSidebar(){ sidebar?.classList.remove('-translate-x-full'); overlay?.classList.remove('hidden'); }
    function closeSidebar(){ sidebar?.classList.add('-translate-x-full'); overlay?.classList.add('hidden'); }
    openBtn?.addEventListener('click', openSidebar);
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);
</script>
</body>
</html>
