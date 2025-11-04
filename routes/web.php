<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request; // <-- TAMBAHKAN INI untuk mengambil data form

/*
|--------------------------------------------------------------------------
| Data Wahana (Simulasi Database)
|--------------------------------------------------------------------------
|
| Kita pindahkan array ini ke atas agar bisa diakses oleh semua route.
| Idealnya, ini ada di database, bukan di sini.
|
*/
$allWahana = [
    ['nama' => 'Bumper Cars',   'gambar' => 'img/wahana/wahana1.jpeg', 'slug' => 'Bumper Cars',
        'deskripsi' => 'Bumper Blast adalah wahana adu seru mobil listrik...',
        'ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: Minimal 130 cm...']],
    ['nama' => 'Drop Tower',     'gambar' => 'img/wahana/wahana2.jpeg', 'slug' => 'Drop Tower',
        'deskripsi' => 'Drop Tower adalah wahana pemacu adrenalin...',
        'ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: 130 -190 cm...']],
    ['nama' => 'Fantasy Voyage',   'gambar' => 'img/wahana/wahana3.jpeg', 'slug' => 'Fantasy Voyage',
        'deskripsi' => 'Fantasy Voyage adalah wahana perahu indoor penuh warna...',
        'ketentuan' => ['Usia: Semua umur (disarankan mulai 4 tahun ke atas)', 'Tinggi badan: Tidak ada batas minimum...']],
    ['nama' => 'Mini Bumper Blast','gambar' => 'img/wahana/wahana4.jpeg',  'slug' => 'Mini Bumper Blast',
        'deskripsi' => 'Mini Bumper Blast adalah versi anak-anak dari wahana bom-bom car...',
        'ketentuan' => ['Usia: 4–10 tahun', 'Tinggi badan: Minimal 100 cm...']],
    ['nama' => 'Mini Glowtopus Spin','gambar' => 'img/wahana/wahana5.jpeg', 'slug' => 'Mini Glowtopus Spin',
        'deskripsi' => 'Mini Glowtopus Spin adalah versi anak-anak dari wahana Glowtopus Spin...',
        'ketentuan' => ['Usia: 4–10 tahun', 'Tinggi badan: Minimal 95 cm...']],
    ['nama' => 'Pirate Ship',      'gambar' => 'img/wahana/wahana6.jpeg',  'slug' => 'Pirate Ship',
        'deskripsi' => 'Pirate Ship adalah wahana klasik berbentuk kapal bajak laut...',
        'ketentuan' => ['Usia: Minimal 10 tahun', 'Tinggi badan: Minimal 130 cm...']],
    ['nama' => 'Rapid River Splash','gambar' => 'img/wahana/wahana7.jpeg', 'slug' => 'Rapid River Splash',
        'deskripsi' => 'Rapid River Splash adalah wahana arung jeram buatan...',
        'ketentuan' => ['Usia: Minimal 10 tahun', 'Tinggi badan: Minimal 130 cm...']],
    ['nama' => 'Rush Rider',       'gambar' => 'img/wahana/wahana8.jpeg',  'slug' => 'Rush Rider',
        'deskripsi' => 'Rush Rider adalah wahana roller coaster berkecepatan tinggi...',
        'ketentuan' => ['Usia: Minimal 12 tahun', 'Tinggi badan: Minimal 135 cm...']],
    ['nama' => 'Sky Wheel',        'gambar' => 'img/wahana/wahana9.jpeg',  'slug' => 'Sky Wheel',
        'deskripsi' => 'Sky Wheel adalah wahana kincir ria...',
        'ketentuan' => ['Usia: di atas 15 tahun', 'Tinggi badan: Minimal 140 cm...']],
    ['nama' => 'Swan Lake Paddle', 'gambar' => 'img/wahana/wahana10.jpeg', 'slug' => 'Swan Lake Paddle',
        'deskripsi' => 'Swan Lake Paddle adalah wahana perahu berbentuk angsa...',
        'ketentuan' => ['Usia: Minimal 7 tahun', 'Anak di bawah 15 tahun wajib didampingi...']],
    ['nama' => 'Trampland',        'gambar' => 'img/wahana/wahana11.jpeg', 'slug' => 'Trampland',
        'deskripsi' => 'TrampoLand adalah wahana permainan yang dirancang...',
        'ketentuan' => ['Usia: Minimal 5 tahun', 'Anak <7 tahun wajib didampingi...']],
    ['nama' => 'Twinkle Carousel', 'gambar' => 'img/wahana/wahana12.jpeg', 'slug' => 'Twinkle Carousel',
        'deskripsi' => 'Twinkle Carousel adalah komidi putar klasik...',
        'ketentuan' => ['Usia: Semua umur (disarankan mulai 3 tahun ke atas)...']],
];


/*
|--------------------------------------------------------------------------
| Route Publik (Tidak Berubah)
|--------------------------------------------------------------------------
*/
Route::get('/test-mail', function () { /* ...kode email Anda... */ });
Route::get('/', function () { return view('homepage'); })->name('homepage');
Route::get('/tiket', function () { return view('tiket'); })->name('tiket');
Route::get('/form-tiket', function () { return view('form-tiket'); })->name('form-tiket');
Route::get('/pembayaran', function () { return view('pembayaran'); })->name('pembayaran');
Route::get('/fasilitas', function () { return view('fasilitas'); })->name('fasilitas');
route::get('/wahana', function () { return view('wahana'); })->name('wahana');

Route::get('/wahana/{slug}', function ($slug) use ($allWahana) { // <-- 'use' untuk mengambil array
    $wahanaDetail = null;
    foreach ($allWahana as $w) {
        if (Str::slug($w['slug']) === Str::slug($slug)) {
            $wahanaDetail = $w;
            break;
        }
    }
    if (!$wahanaDetail) { abort(404); }
    $otherWahana = array_filter($allWahana, function($w) use ($slug) {
         return Str::slug($w['slug']) !== Str::slug($slug);
    });
    $otherWahana = array_slice(array_values($otherWahana), 0, 3);
    return view('wahana-detail', ['wahana' => $wahanaDetail, 'others' => $otherWahana]);
})->name('wahana.detail');


/*
|--------------------------------------------------------------------------
| Route Admin (Diperbarui untuk CRUD)
|--------------------------------------------------------------------------
*/

// Grup untuk semua URL yang diawali /admin
Route::prefix('admin')->group(function() use ($allWahana) { // <-- 'use' untuk mengambil array

    // 1. READ (Halaman utama admin wahana)
    //    URL: /admin/wahana
    Route::get('/wahana', function () use ($allWahana) {
        // Sekarang kita passing SEMUA wahana ke view
        return view('admin.awahana', [
            'wahanaItems' => $allWahana 
        ]);
    })->name('admin.wahana');

    // 2. UPDATE (Menampilkan form edit)
    //    URL: /admin/wahana/edit/nama-wahana-slug
    Route::get('/wahana/edit/{slug}', function ($slug) use ($allWahana) {
        $wahanaDetail = null;
        foreach ($allWahana as $w) {
            if (Str::slug($w['slug']) === Str::slug($slug)) {
                $wahanaDetail = $w;
                break;
            }
        }
        if (!$wahanaDetail) { abort(404); }

        // Kirim data wahana yang ditemukan ke view edit
        return view('admin.editwahana', [
            'wahana' => $wahanaDetail
        ]);
    })->name('admin.wahana.edit');

    // 3. UPDATE (Memproses form edit)
    //    URL: /admin/wahana/update/nama-wahana-slug (Method: POST)
    Route::post('/wahana/update/{slug}', function (Request $request, $slug) {
        // SIMULASI: Kita ambil data dari form
        $nama = $request->input('nama_wahana');
        $deskripsi = $request->input('deskripsi');
        $ketentuan = $request->input('ketentuan'); // Ini string
        
        // Logika update database seharusnya terjadi di sini
        // ...
        // $wahana = Wahana::find($slug);
        // $wahana->nama = $nama;
        // $wahana->deskripsi = $deskripsi;
        // $wahana->ketentuan = explode("\n", $ketentuan); // Pecah lagi jadi array
        // $wahana->save();
        
        // Karena kita hanya simulasi, kita langsung redirect kembali
        // dengan pesan sukses.
        return redirect()->route('admin.wahana')
                         ->with('success', 'Data wahana ' . $nama . ' (slug: ' . $slug . ') berhasil diperbarui (simulasi).');

    })->name('admin.wahana.update');

    // 4. CREATE (Menampilkan form tambah) - (Belum dibuat view-nya)
    // Route::get('/wahana/create', ...)->name('admin.wahana.create');
    
    // 5. CREATE (Memproses form tambah) - (Belum dibuat view-nya)
    // Route::post('/wahana/store', ...)->name('admin.wahana.store');

    // 6. DELETE (Memproses hapus data)
    // Route::post('/wahana/delete/{slug}', ...)->name('admin.wahana.delete');

});

