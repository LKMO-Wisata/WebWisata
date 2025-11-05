<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Fasilitas | Dashboard Admin</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
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
                    Dashboard / <span class="font-medium text-gray-800">Atur Fasilitas</span>
                </div>
                <div class="lg:hidden"></div>
            </div>
        </header>

        <main class="flex-1 p-6 md:p-8">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Atur Fasilitas</h1>

                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm" role="alert">
                        <p class="font-bold">Sukses!</p><p>{{ session('success') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-md shadow-sm">
                        <p class="font-bold mb-1">Validasi gagal:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex justify-end mb-6">
                    <a href="{{ route('admin.fasilitas.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-lg shadow-md transition-colors duration-200 flex items-center space-x-2">
                        <svg data-lucide="plus" class="w-5 h-5"></svg>
                        <span>Tambah Fasilitas</span>
                    </a>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Fasilitas</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                use Illuminate\Support\Str;
                            @endphp

                            @forelse($fasilitasItems as $item)
                                @php
                                    // Prioritas gambar: accessor image_url → accessor gambar_url → http/https → public/img → storage → placeholder
                                    $foto = $item->image_url
                                        ?? $item->gambar_url
                                        ?? (isset($item->gambar) && Str::startsWith($item->gambar, ['http://','https://'])
                                            ? $item->gambar
                                            : (isset($item->gambar) && Str::startsWith($item->gambar, ['img/','/img/'])
                                                ? asset(ltrim($item->gambar,'/'))
                                                : (isset($item->gambar)
                                                    ? asset('storage/'.ltrim($item->gambar,'/'))
                                                    : asset('img/no-image.png'))));
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $loop->iteration + ((method_exists($fasilitasItems, 'firstItem') && $fasilitasItems->firstItem()) ? ($fasilitasItems->firstItem() - 1) : 0) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img src="{{ $foto }}"
                                             alt="{{ $item->nama }}"
                                             class="h-16 w-24 object-cover rounded-md shadow-sm border border-gray-200"
                                             loading="lazy"
                                             onerror="this.onerror=null;this.src='{{ asset('img/no-image.png') }}';">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                        <div>{{ $item->nama }}</div>
                                        <div class="text-xs text-gray-400">/{{ $item->slug }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $item->deskripsi }}">
                                        {{ $item->deskripsi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('admin.fasilitas.edit', $item) }}"
                                           class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md shadow-sm text-xs font-medium transition-colors">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.fasilitas.destroy', $item) }}" method="POST" class="inline-block"
                                              onsubmit="return confirm('Anda yakin ingin menghapus fasilitas ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md shadow-sm text-xs font-medium transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data fasilitas.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(method_exists($fasilitasItems, 'links'))
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $fasilitasItems->links() }}
                        </div>
                    @endif
                </div>

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
