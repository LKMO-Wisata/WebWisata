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
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <div class="flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-4 md:p-8 lg:ml-64 transition-all duration-300">

            <div class="text-sm text-gray-500 mb-4 mt-12 lg:mt-0">
                <a href="{{ route('admin.wahana.index') }}" class="hover:underline">Dashboard</a> /
                <a href="{{ route('admin.wahana.index') }}" class="hover:underline">Atur Wahana</a> /
                <span class="font-semibold text-gray-700">Tambah Wahana</span>
            </div>

            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-6">Tambah Wahana Baru</h2>

            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md">
                    <p class="font-bold mb-1">Validasi gagal:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                    </ul>
                </div>
            @endif

            {{-- Flash success --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form ini mengirim ke route 'admin.wahana.store' --}}
            <form id="createWahanaForm" action="{{ route('admin.wahana.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">

                    {{-- Kolom kiri: Foto --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white p-4 md:p-6 rounded-lg shadow-xl">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Wahana</label>

                            {{-- Placeholder Preview --}}
                            <div id="imagePreview" class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 mb-4 overflow-hidden">
                                Preview Foto
                            </div>

                            <label for="gambar" class="cursor-pointer w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 block">
                                Pilih Foto (bisa banyak)
                            </label>
                            {{-- Controller mengharapkan name="gambar[]" --}}
                            <input type="file" name="gambar[]" id="gambar" class="hidden" accept="image/*" multiple required>
                            <p class="text-xs text-gray-500 mt-2">Format: jpg, jpeg, png, webp. Maks 4MB/file. Layout: 16:9</p>
                        </div>
                    </div>

                    {{-- Kolom kanan: Data teks --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white p-4 md:p-6 rounded-lg shadow-xl space-y-6">

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Wahana</label>
                                <input type="text" name="nama" id="nama"
                                       value="{{ old('nama') }}" placeholder="Contoh: Bumper Cars"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug (opsional)</label>
                                <input type="text" name="slug" id="slug"
                                       value="{{ old('slug') }}" placeholder="contoh: bumper-cars"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="text-[11px] text-gray-500 mt-1">Kosongkan untuk membiarkan sistem mengisi otomatis dari nama.</p>
                            </div>

                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Wahana</label>
                                <textarea name="deskripsi" id="deskripsi" rows="8"
                                          placeholder="Deskripsi singkat wahana..."
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>{{ old('deskripsi') }}</textarea>
                            </div>

                            <div>
                                <label for="ketentuan_text" class="block text-sm font-medium text-gray-700">Syarat dan Ketentuan</label>
                                <p class="text-xs text-gray-500 mb-1">Masukkan satu ketentuan per baris. Akan dikirim sebagai array ke server.</p>
                                <textarea id="ketentuan_text" rows="8"
                                          placeholder="Contoh:&#10;Usia minimal 15 tahun&#10;Tinggi badan minimal 130 cm"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('ketentuan_text') }}</textarea>
                            </div>

                            {{-- (opsional) status aktif default true di controller --}}

                            <div class="text-right">
                                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0d1741] hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Simpan Wahana Baru
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Hidden inputs untuk ketentuan[] --}}
                <div id="ketentuanHiddenInputs"></div>
            </form>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- Sidebar ---
            const sidebar = document.getElementById('sidebar');
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const toggleSidebar = () => {
                sidebar?.classList.toggle('-translate-x-full');
                sidebarOverlay?.classList.toggle('hidden');
            };
            hamburgerBtn?.addEventListener('click', toggleSidebar);
            sidebarCloseBtn?.addEventListener('click', toggleSidebar);
            sidebarOverlay?.addEventListener('click', toggleSidebar);

            // --- Preview multi file ---
            const fileInput = document.getElementById('gambar');
            const imagePreview = document.getElementById('imagePreview');
            fileInput?.addEventListener('change', () => {
                if (!fileInput.files || fileInput.files.length === 0) {
                    imagePreview.innerHTML = 'Preview Foto';
                    return;
                }
                // Tampilkan foto pertama sebagai preview
                const file = fileInput.files[0];
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
                };
                reader.readAsDataURL(file);
            });

            // --- Kirim ketentuan sebagai array name="ketentuan[]" ---
            const form = document.getElementById('createWahanaForm');
            const ketentuanText = document.getElementById('ketentuan_text');
            const hiddenContainer = document.getElementById('ketentuanHiddenInputs');

            form?.addEventListener('submit', () => {
                hiddenContainer.innerHTML = '';
                const lines = (ketentuanText.value || '')
                    .split('\n')
                    .map(s => s.trim())
                    .filter(s => s.length > 0);

                lines.forEach(v => {
                    const i = document.createElement('input');
                    i.type = 'hidden';
                    i.name = 'ketentuan[]';
                    i.value = v;
                    hiddenContainer.appendChild(i);
                });
            });
        });
    </script>

</body>
</html>
