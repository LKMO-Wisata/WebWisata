<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| DATA SIMULASI (SUMBER DATA UTAMA)
|--------------------------------------------------------------------------
|
| Kita letakkan semua data simulasi di sini agar bisa diakses
| oleh semua rute admin dan rute publik.
|
*/

/**
 * DATA WAHANA (Dari file web.php Anda sebelumnya)
 */
$allWahana = [
    // Data dari kamu + Placeholder
    ['nama' => 'Bumper Cars',     'gambar' => ['img/wahana/Bumper Cars/1.jpeg','img/wahana/Bumper Cars/2.jpeg','img/wahana/Bumper Cars/3.jpeg','img/wahana/Bumper Cars/4.jpeg'],  'slug' => 'Bumper Cars',
        'deskripsi' => 'Bumper Blast adalah wahana adu seru mobil listrik yang dirancang khusus untuk pengunjung remaja dan dewasa. Setiap pengemudi dapat mengendalikan mobilnya di arena tertutup dan menabrakkan mobil lain dengan aman menggunakan sistem bemper pelindung tebal. Musik upbeat, lampu warna-warni, dan suara dentuman membuat suasana semakin seru dan kompetitif.','ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: Minimal 130 cm untuk mengemudi sendiri','kapasitas per mobil: 1-2 orang (maksimum 150 kg total)']],
    ['nama' => 'Drop Tower',     'gambar' => ['img/wahana/Drop Tower/1.jpeg','img/wahana/Drop Tower/2.jpeg','img/wahana/Drop Tower/3.jpeg','img/wahana/Drop Tower/4.jpeg'],  'slug' => 'Drop Tower',
        'deskripsi' => 'Drop Tower adalah wahana pemacu adrenalin yang membawa pengunjung naik ke puncak menara setinggi puluhan meter sebelum dijatuhkan dengan kecepatan tinggi secara tiba-tiba! Sensasi melayang seolah kehilangan gravitasi menjadikan wahana ini favorit bagi para pencinta tantangan ekstrem. Dari atas menara, pengunjung juga bisa menikmati pemandangan seluruh area taman sebelum terjun bebas ke bawah. ','ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: 130 -190 cm', 'Kesehatan: Tidak untuk yang memiliki masalah jantung, tekanan darah tinggi, atau kondisi medis tertentu', 'Berat maksimal: 100 kg','kapasitas per sesi: 12-16 orang']],
    ['nama' => 'Fantasy Voyage',   'gambar' => ['img/wahana/Fantasy Voyage/1.jpeg','img/wahana/Fantasy Voyage/2.jpeg','img/wahana/Fantasy Voyage/3.jpeg','img/wahana/Fantasy Voyage/4.jpeg'],  'slug' => 'Fantasy Voyage',
        'deskripsi' => 'Fantasy Voyage adalah wahana perahu indoor penuh warna dan imajinasi di Zona Fantasi Cahaya. Pengunjung akan berlayar melewati dunia cahaya ajaib dengan karakter lucu, bangunan berkilau, dan musik ceria yang membawa suasana seperti negeri dongeng. Setiap area menggambarkan tema fantasi berbeda, dari kerajaan pelangi hingga hutan bintang', 'ketentuan' => ['Usia: Semua umur (disarankan mulai 4 tahun ke atas)', 'Tinggi badan: Tidak ada batas minimum','Kapasitas per perahu: 6-8 orang']],
    // ... (Tambahkan sisa data wahana Anda di sini) ...
    ['nama' => 'Twinkle Carousel', 'gambar' => ['img/wahana/Twinkle Carousel/1.jpeg','img/wahana/Twinkle Carousel/2.jpeg','img/wahana/Twinkle Carousel/3.jpeg','img/wahana/Twinkle Carousel/4.jpeg'], 'slug' => 'Twinkle Carousel',
        'deskripsi' => 'Twinkle Carousel adalah komidi putar klasik yang dipenuhi lampu berkilau dan musik lembut, menciptakan suasana dongeng yang hangat dan menyenangkan.', 'ketentuan' => ['Usia: Semua umur (disarankan mulai 3 tahun ke atas) Anak di bawah 5 tahun wajib didampingi orang tua', 'Tinggi badan: Tidak ada batas minimum', 'Kapasitas: ±40 orang per sesi']],
];


/**
 * DATA FASILITAS (Baru, dari fasilitas.blade.php)
 * Saya tambahkan 'slug' untuk URL (Edit/Hapus)
 */
$allFasilitas = [
    ['nama' => 'Musholah',    'desc' => 'Fasilitas tempat ibadah yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Mushollah.jpg', 'slug' => 'musholah'],
    ['nama' => 'Parking Lot', 'desc' => 'Fasilitas tempat parkir yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Parking Lot.jpg', 'slug' => 'parking-lot'],
    ['nama' => 'Gazebo',      'desc' => 'Fasilitas gazebo yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Gazebo.jpg', 'slug' => 'gazebo'],
    ['nama' => 'Food Court',  'desc' => 'Fasilitas food court yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Food Court.jpg', 'slug' => 'food-court'],
    ['nama' => 'Toilet',      'desc' => 'Fasilitas toilet dan locker yang bersih dan nyaman tersedia untuk pengunjung.', 'gambar' => 'Toilet.jpg', 'slug' => 'toilet'],
];


/**
 * DATA TIKET (Baru, dari tiket.blade.php)
 * Ini akan menyimpan harga dasar.
 */
$ticketData = [
    'dewasa' => 35000,
    'anak' => 30000,
    'fast_track' => 15000
];


/*
|--------------------------------------------------------------------------
| ROUTE PUBLIK (MENGGUNAKAN DATA DI ATAS)
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('homepage'))->name('homepage');
Route::get('/tiket', fn() => view('tiket'))->name('tiket'); // Halaman ini punya logic Alpine.js sendiri
Route::get('/form-tiket', fn() => view('form-tiket'))->name('form-tiket');
Route::get('/pembayaran', fn() => view('pembayaran'))->name('pembayaran');

Route::post('/feedback', function (Request $request) {
    // Simulasi simpan feedback
    Log::info('Feedback diterima:', $request->all());
    return back()->with('success', 'Terima kasih atas masukan Anda!');
})->name('feedback.store');

// Route Fasilitas Publik (Menggunakan data $allFasilitas)
Route::get('/fasilitas', function () use ($allFasilitas) {
    return view('fasilitas', ['fasilitas' => $allFasilitas]);
})->name('fasilitas');

// Route Wahana Publik (Menggunakan data $allWahana)
Route::get('/wahana', fn() => view('wahana'))->name('wahana');
Route::get('/wahana/{slug}', function ($slug) use ($allWahana) {
    $wahanaDetail = collect($allWahana)->firstWhere(fn($w) => Str::slug($w['slug']) === $slug);
    if (!$wahanaDetail) abort(404);
    $otherWahana = collect($allWahana)->where(fn($w) => Str::slug($w['slug']) !== $slug)->take(3)->values();
    return view('wahana-detail', compact('wahanaDetail', 'otherWahana'));
})->name('wahana.detail');


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/

// --- GRUP ADMIN (Nanti bisa ditambahkan middleware 'auth' di sini) ---
Route::prefix('admin')->name('admin.')->group(function () use ($allWahana, $allFasilitas, $ticketData) {

    // --- AUTENTIKASI ADMIN ---
    Route::get('/login', fn() => view('admin.loginadmin'))->name('login');

    Route::post('/login', function (Request $request) {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        if ($request->email === 'admin@' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.wahana')->with('success', 'Login berhasil!');
        }
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    })->name('login.post');

    Route::post('/logout', function () {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    })->name('logout');

    Route::get('/debug', function () {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.wahana');
    })->name('debug');


    // --- ATUR WAHANA ---
    Route::get('/wahana', function () use ($allWahana) {
        return view('admin.awahana', ['wahanaItems' => $allWahana]);
    })->name('wahana');

    Route::get('/wahana/create', fn() => view('admin.tambahwahana'))->name('wahana.create');
    Route::post('/wahana/store', function (Request $request) {
        return redirect()->route('admin.wahana')->with('success', "Wahana '{$request->nama_wahana}' ditambahkan (simulasi).");
    })->name('wahana.store');

    Route::get('/wahana/edit/{slug}', function ($slug) use ($allWahana) {
        $wahana = collect($allWahana)->firstWhere('slug', $slug);
        if (!$wahana) return redirect()->route('admin.wahana')->with('error', 'Wahana tidak ditemukan!');
        return view('admin.editwahana', ['wahana' => $wahana]);
    })->name('wahana.edit');

    Route::post('/wahana/update/{slug}', function (Request $request, $slug) {
        return redirect()->route('admin.wahana')->with('success', "Wahana '{$request->nama_wahana}' diperbarui (simulasi).");
    })->name('wahana.update');


    // --- ATUR FASILITAS (BARU) ---
    Route::get('/fasilitas', function () use ($allFasilitas) {
        return view('admin.aturfasilitas', ['fasilitasItems' => $allFasilitas]);
    })->name('fasilitas');

    Route::get('/fasilitas/create', fn() => view('admin.tambahfasilitas'))->name('fasilitas.create');
    Route::post('/fasilitas/store', function (Request $request) {
        return redirect()->route('admin.fasilitas')->with('success', "Fasilitas '{$request->nama_fasilitas}' ditambahkan (simulasi).");
    })->name('fasilitas.store');

    Route::get('/fasilitas/edit/{slug}', function ($slug) use ($allFasilitas) {
        $fasilitas = collect($allFasilitas)->firstWhere('slug', $slug);
        if (!$fasilitas) return redirect()->route('admin.fasilitas')->with('error', 'Fasilitas tidak ditemukan!');
        return view('admin.editfasilitas', ['fasilitas' => $fasilitas]);
    })->name('fasilitas.edit');

    Route::post('/fasilitas/update/{slug}', function (Request $request, $slug) {
        return redirect()->route('admin.fasilitas')->with('success', "Fasilitas '{$request->nama_fasilitas}' diperbarui (simulasi).");
    })->name('fasilitas.update');

    Route::post('/fasilitas/delete/{slug}', function ($slug) {
        return redirect()->route('admin.fasilitas')->with('success', "Fasilitas dihapus (simulasi).");
    })->name('fasilitas.delete');


    // --- ATUR TIKET (BARU) ---
    Route::get('/tiket', function () use ($ticketData) {
        return view('admin.aturtiket', ['tiket' => $ticketData]);
    })->name('tiket');

    Route::post('/tiket/update', function (Request $request) {
        // Simulasi update harga
        Log::info('Data tiket disimulasikan untuk update:', $request->all());
        return redirect()->route('admin.tiket')->with('success', 'Harga tiket berhasil diperbarui (simulasi).');
    })->name('tiket.update');

});