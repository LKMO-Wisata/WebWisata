<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit - {{ $wahana['nama'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
</head>
<body class="bg-gray-100">

    <div class="flex">
        {{-- 1. Memanggil Sidebar --}}
        @include('layouts.sidebar')

        {{-- 2. Konten Utama --}}
        <main class="flex-1 p-8 ml-64">

            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 mb-4">
                <a href="{{ route('admin.wahana') }}" class="hover:underline">Dashboard</a> /
                <a href="{{ route('admin.wahana') }}" class="hover:underline">Atur Wahana</a> /
                <span class="font-semibold text-gray-700">Edit Wahana</span>
            </div>

            {{-- Judul Halaman --}}
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit Wahana</h2>

            {{-- 
              Form untuk mengirim data update
              Action: Menuju route 'admin.wahana.update'
              Method: POST (wajib untuk form)
            --}}
            <form action="{{ route('admin.wahana.update', ['slug' => $wahana['slug']]) }}" method="POST">
                {{-- Token keamanan Laravel, WAJIB ADA --}}
                @csrf 

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    {{-- Kolom Kiri (Gambar) --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-lg shadow-xl">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Wahana</label>
                            <img src="{{ asset($wahana['gambar']) }}" alt="{{ $wahana['nama'] }}" class="w-full h-auto object-cover rounded-lg shadow-md mb-4">
                            
                            {{-- Button (dummy, belum ada fungsi ganti gambar) --}}
                            <button type="button" class="w-full text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Edit Foto
                            </button>
                        </div>
                    </div>

                    {{-- Kolom Kanan (Info) --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white p-6 rounded-lg shadow-xl space-y-6">
                            
                            {{-- Nama Wahana --}}
                            <div>
                                <label for="nama_wahana" class="block text-sm font-medium text-gray-700">Nama Wahana</label>
                                <input type="text" name="nama_wahana" id="nama_wahana" 
                                       value="{{ $wahana['nama'] }}" 
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            {{-- Deskripsi Wahana --}}
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Wahana</label>
                                <textarea name="deskripsi" id="deskripsi" rows="8" 
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ $wahana['deskripsi'] }}</textarea>
                            </div>

                            {{-- Syarat dan Ketentuan --}}
                            <div>
                                <label for="ketentuan" class="block text-sm font-medium text-gray-700">Syarat dan Ketentuan</label>
                                <p class="text-xs text-gray-500 mb-1">Masukkan satu ketentuan per baris.</p>
                                <textarea name="ketentuan" id="ketentuan" rows="8" 
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{-- 
                                    Kita ubah array 'ketentuan' menjadi string dengan pemisah baris baru 
                                --}}{{ implode("\n", $wahana['ketentuan']) }}</textarea>
                            </div>

                            {{-- Tombol Simpan --}}
                            <div classS="text-right">
                                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0d1741] hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </form>
            
        </main>
    </div>

</body>
</html>
