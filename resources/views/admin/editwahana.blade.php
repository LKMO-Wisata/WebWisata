<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - {{ $wahana->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
</head>
<body class="bg-gray-100">

    {{-- Tombol hamburger untuk mobile --}}
    <button id="hamburgerBtn" class="fixed top-4 left-4 z-40 p-2 bg-gray-800 text-white rounded-md lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <div class="flex">
        @include('layouts.sidebar')

        <main class="flex-1 p-4 md:p-8 lg:ml-64 transition-all duration-300">

            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 mb-4 mt-12 lg:mt-0">
                <a href="{{ route('admin.wahana.index') }}" class="hover:underline">Dashboard</a> /
                <a href="{{ route('admin.wahana.index') }}" class="hover:underline">Atur Wahana</a> /
                <span class="font-semibold text-gray-700">Edit Wahana</span>
            </div>

            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-6">Edit Wahana</h2>

            {{-- Flash success --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
                    <p class="font-semibold mb-1">Terjadi kesalahan:</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM EDIT --}}
            <form id="editWahanaForm"
                  action="{{ route('admin.wahana.update', $wahana) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8">

                    {{-- Kiri: Foto --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white p-4 md:p-6 rounded-lg shadow-xl">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Utama</label>

                            <img src="{{ $wahana->primary_photo_url ?? asset('img/no-image.png') }}"
                                 alt="{{ $wahana->nama }}"
                                 class="w-full h-48 object-cover rounded-lg shadow-md mb-4 border border-gray-200">

                            <label for="gambar" class="cursor-pointer w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 block">
                                Tambah Foto (bisa banyak)
                            </label>
                            {{-- Controller menerima name="gambar[]" --}}
                            <input type="file" name="gambar[]" id="gambar" class="hidden" accept="image/*" multiple>
                            <p class="text-xs text-gray-500 mt-2">Format: jpg, jpeg, png, webp. Maks 4MB/file.</p>

                            @if($wahana->photos->count())
                                <div class="mt-6">
                                    <h4 class="text-sm font-semibold mb-2">Foto Saat Ini</h4>
                                    <div class="space-y-2 max-h-56 overflow-auto pr-2">
                                        @foreach($wahana->photos as $p)
                                            <div class="flex items-center gap-3 p-2 border rounded">
                                                <img src="{{ $p->url }}" class="w-16 h-12 object-cover rounded border" alt="">
                                                <div class="flex-1">
                                                    <div class="text-xs text-gray-700 truncate">{{ $p->path }}</div>
                                                    <div class="text-[11px] text-gray-500">Urutan: {{ $p->ordering }}</div>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <label class="flex items-center gap-1 text-xs">
                                                        <input type="radio" name="primary_photo_id" value="{{ $p->id }}" {{ $p->is_primary ? 'checked' : '' }}>
                                                        <span>Utama</span>
                                                    </label>
                                                    <label class="flex items-center gap-1 text-xs text-red-600">
                                                        <input type="checkbox" name="delete_photo_ids[]" value="{{ $p->id }}">
                                                        <span>Hapus</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="text-[11px] text-gray-500 mt-2">Catatan: Foto dari <code>public/img/...</code> tidak dihapus fisiknya, hanya relasi.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Kanan: Data teks --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white p-4 md:p-6 rounded-lg shadow-xl space-y-6">

                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Wahana</label>
                                <input type="text" name="nama" id="nama"
                                       value="{{ old('nama', $wahana->nama) }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug (opsional)</label>
                                <input type="text" name="slug" id="slug"
                                       value={{ old('slug', $wahana->slug) ? '"'.old('slug', $wahana->slug).'"' : '' }}
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                       placeholder="contoh: bumper-cars">
                                <p class="text-[11px] text-gray-500 mt-1">Kosongkan untuk tetap memakai slug saat ini / auto dari nama.</p>
                            </div>

                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Wahana</label>
                                <textarea name="deskripsi" id="deskripsi" rows="8"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('deskripsi', $wahana->deskripsi) }}</textarea>
                            </div>

                            <div>
                                <label for="ketentuan_text" class="block text-sm font-medium text-gray-700">Syarat dan Ketentuan</label>
                                <p class="text-xs text-gray-500 mb-1">Satu ketentuan per baris. Akan dikirim sebagai array ke server.</p>
                                <textarea id="ketentuan_text" rows="8"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('ketentuan_text', implode("\n", $wahana->ketentuan ?? [])) }}</textarea>
                            </div>

                            <div class="flex items-center gap-2">
                                <input id="is_active" name="is_active" type="checkbox" value="1"
                                       class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                                       {{ old('is_active', $wahana->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="text-sm text-gray-700">Aktif</label>
                            </div>

                            <div class="text-right">
                                <button type="submit"
                                        class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0d1741] hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- Hidden ketentuan[] --}}
                <div id="ketentuanHiddenInputs"></div>
            </form>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar
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

            // Label jumlah file dipilih
            const fileInput = document.getElementById('gambar');
            const label = document.querySelector('label[for="gambar"]');
            fileInput?.addEventListener('change', () => {
                label.textContent = (fileInput.files && fileInput.files.length > 0)
                    ? `${fileInput.files.length} file dipilih`
                    : 'Tambah Foto (bisa banyak)';
            });

            // Kirim ketentuan sebagai array
            const form = document.getElementById('editWahanaForm');
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
