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
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
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

                    {{-- Konten Tabel Fasilitas --}}
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('admin.fasilitas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-lg shadow-md transition-colors duration-200 flex items-center space-x-2">
                            <svg data-lucide="plus" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="5" y2="19"/><line x1="5" x2="19" y1="12" y2="12"/></svg>
                            <span>Tambah Fasilitas</span>
                        </a>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Foto</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Fasilitas</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($fasilitasItems as $index => $item)
                                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('img/fasilitas/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="h-16 w-24 object-cover rounded-md shadow-sm border border-gray-200">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">{{ $item['nama'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $item['desc'] }}">{{ $item['desc'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('admin.fasilitas.edit', ['slug' => $item['slug']]) }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md shadow-sm text-xs font-medium transition-colors">Edit</a>
                                            <form action="{{ route('admin.fasilitas.delete', ['slug' => $item['slug']]) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus fasilitas ini?');">
                                                @csrf
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md shadow-sm text-xs font-medium transition-colors">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">Belum ada data fasilitas.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- Akhir Konten Tabel Fasilitas --}}

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