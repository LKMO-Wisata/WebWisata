<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Atur Wahana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png"> 
</head>
<body class="bg-gray-100">

    {{-- 
      Data wahana ($wahanaItems) sekarang dikirim dari routes/web.php,
      blok @php simulasi data sudah dihapus dari sini.
    --}}

    <div class="flex">
        {{-- 1. Memanggil Sidebar --}}
        @include('layouts.sidebar')

        {{-- 2. Konten Utama --}}
        <main class="flex-1 p-8 ml-64">
            
            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 mb-4">
                Dashboard / <span class="font-semibold text-gray-700">Atur Wahana</span>
            </div>

            {{-- Header Konten --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Atur Wahana</h2>
                <a href="#" class="bg-[#0d1741] hover:bg-blue-800 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Tambah Wahana
                </a>
            </div>

            {{-- Notifikasi Sukses (setelah update) --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Container Tabel --}}
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Foto</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Wahana</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Deskripsi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        {{-- Looping SEMUA data dari $wahanaItems --}}
                        @foreach ($wahanaItems as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" class="h-16 w-24 object-cover rounded-md shadow-sm border border-gray-200">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                {{ $item['nama'] }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $item['deskripsi'] }}">
                                {{ $item['deskripsi'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                {{-- Tombol Edit SEKARANG BERFUNGSI --}}
                                <a href="{{ route('admin.wahana.edit', ['slug' => $item['slug']]) }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-4 rounded-md shadow-sm text-xs font-medium transition-colors">
                                   Edit
                                </a>
                                <button class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-white py-1.5 px-4 rounded-md shadow-sm text-xs font-medium transition-colors">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </main>
    </div>

</body>
</html>

