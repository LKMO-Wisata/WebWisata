<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Data Wahana (Simulasi Database)
|--------------------------------------------------------------------------
*/
Route::middleware([])->group(function () {

    $allWahana = [
        ['nama' => 'Bumper Cars',   'gambar' => 'img/wahana/wahana1.jpeg', 'slug' => 'Bumper Cars',
            'deskripsi' => 'Bumper Blast adalah wahana adu seru mobil listrik yang dirancang khusus untuk pengunjung remaja dan dewasa. Setiap pengemudi dapat mengendalikan mobilnya di arena tertutop dan menabrakkan mobil lain dengan aman menggunakan sistem bemper pelindung tebal. Musik upbeat, lampu warna-warni, dan suara dentuman membuat suasana semakin seru dan kompetitif.',
            'ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: Minimal 130 cm untuk mengemudi sendiri','kapasitas per mobil: 1-2 orang (maksimum 150 kg total)']],
        ['nama' => 'Drop Tower',   'gambar' => 'img/wahana/wahana2.jpeg', 'slug' => 'Drop Tower',
            'deskripsi' => 'Drop Tower adalah wahana pemacu adrenalin yang membawa pengunjung naik ke puncak menara setinggi puluhan meter sebelum dijatuhkan dengan kecepatan tinggi secara tiba-tiba! Sensasi melayang seolah kehilangan gravitasi menjadikan wahana ini favorit bagi para pencinta tantangan ekstrem.',
            'ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: 130 -190 cm', 'Kesehatan: Tidak untuk yang memiliki masalah jantung', 'Berat maksimal: 100 kg']],
        ['nama' => 'Fantasy Voyage', 'gambar' => 'img/wahana/wahana3.jpeg', 'slug' => 'Fantasy Voyage',
            'deskripsi' => 'Fantasy Voyage adalah wahana perahu indoor penuh warna dan imajinasi di Zona Fantasi Cahaya. Pengunjung akan berlayar melewati dunia cahaya ajaib dengan karakter lucu.',
            'ketentuan' => ['Usia: Semua umur', 'Kapasitas per perahu: 6-8 orang']],
        ['nama' => 'Mini Bumper Blast','gambar' => 'img/wahana/wahana4.jpeg', 'slug' => 'Mini Bumper Blast',
            'deskripsi' => 'Mini Bumper Blast adalah versi anak-anak dari wahana bom-bom car klasik. Dirancang dengan ukuran mobil yang lebih kecil dan kecepatan aman.',
            'ketentuan' => ['Usia: 4–10 tahun', 'Tinggi badan: Minimal 100 cm']],
        ['nama' => 'Mini Glowtopus Spin','gambar' => 'img/wahana/wahana5.jpeg', 'slug' => 'Mini Glowtopus Spin',
            'deskripsi' => 'Mini Glowtopus Spin adalah versi anak-anak dari wahana Glowtopus Spin yang penuh warna dan lampu neon.',
            'ketentuan' => ['Usia: 4–10 tahun', 'Tinggi badan: Minimal 95 cm']],
        ['nama' => 'Pirate Ship',   'gambar' => 'img/wahana/wahana6.jpeg', 'slug' => 'Pirate Ship',
            'deskripsi' => 'Pirate Ship adalah wahana klasik berbentuk kapal bajak laut raksasa yang berayun maju-mundur dengan kecepatan tinggi!',
            'ketentuan' => ['Usia: Minimal 10 tahun', 'Tinggi badan: Minimal 130 cm']],
        ['nama' => 'Rapid River Splash','gambar' => 'img/wahana/wahana7.jpeg', 'slug' => 'Rapid River Splash',
            'deskripsi' => 'Rapid River Splash adalah wahana arung jeram buatan yang membawa pengunjung menyusuri lintasan air penuh kejutan.',
            'ketentuan' => ['Usia: Minimal 10 tahun', 'Kapasitas per perahu: 6–8 orang']],
        ['nama' => 'Rush Rider',   'gambar' => 'img/wahana/wahana8.jpeg', 'slug' => 'Rush Rider',
            'deskripsi' => 'Rush Rider adalah wahana roller coaster berkecepatan tinggi yang membawa pengunjung meluncur di jalur penuh tikungan tajam.',
            'ketentuan' => ['Usia: Minimal 12 tahun', 'Tinggi badan: Minimal 135 cm']],
        ['nama' => 'Sky Wheel',   'gambar' => 'img/wahana/wahana9.jpeg', 'slug' => 'Sky Wheel',
            'deskripsi' => 'Sky Wheel adalah wahana kincir ria yang menawarkan pengalaman menikmati pemandangan dari ketinggian dengan suasana santai.',
            'ketentuan' => ['Usia: di atas 15 tahun', 'Tinggi badan: Minimal 140 cm']],
        ['nama' => 'Swan Lake Paddle', 'gambar' => 'img/wahana/wahana10.jpeg', 'slug' => 'Swan Lake Paddle',
            'deskripsi' => 'Swan Lake Paddle adalah wahana perahu berbentuk angsa yang mengajak pengunjung berkeliling di danau buatan yang tenang.',
            'ketentuan' => ['Usia: Minimal 7 tahun', 'Kapasitas per perahu: 2 orang']],
        ['nama' => 'Trampland',   'gambar' => 'img/wahana/wahana11.jpeg', 'slug' => 'Trampland',
            'deskripsi' => 'TrampoLand adalah wahana permainan yang dirancang untuk anak-anak dan remaja. Pengunjung bisa melompat bebas di atas trampolin raksasa.',
            'ketentuan' => ['Usia: Minimal 5 tahun', 'Tinggi badan: Minimal 100 cm']],
        ['nama' => 'Twinkle Carousel', 'gambar' => 'img/wahana/wahana12.jpeg', 'slug' => 'Twinkle Carousel',
            'deskripsi' => 'Twinkle Carousel adalah komidi putar klasik yang dipenuhi lampu berkilau dan musik lembut, menciptakan suasana dongeng yang hangat dan menyenangkan.',
            'ketentuan' => ['Usia: Semua umur', 'Kapasitas: ±40 orang per sesi']],
    ];

    /*
    |--------------------------------------------------------------------------
    | ROUTE PUBLIK (TIDAK DIUBAH)
    |--------------------------------------------------------------------------
    */
    Route::get('/', fn() => view('homepage'))->name('homepage');
    Route::get('/tiket', fn() => view('tiket'))->name('tiket');
    Route::get('/form-tiket', fn() => view('form-tiket'))->name('form-tiket');
    Route::get('/pembayaran', fn() => view('pembayaran'))->name('pembayaran');
    Route::get('/fasilitas', fn() => view('fasilitas'))->name('fasilitas');
    Route::get('/wahana', fn() => view('wahana'))->name('wahana');

    Route::get('/wahana/{slug}', function ($slug) use ($allWahana) {
        $wahanaDetail = collect($allWahana)->firstWhere(fn($w) => Str::slug($w['slug']) === $slug);
        if (!$wahanaDetail) abort(404);
        $otherWahana = collect($allWahana)->where(fn($w) => Str::slug($w['slug']) !== $slug)->take(3)->values();
        return view('wahana-detail', compact('wahanaDetail', 'otherWahana'));
    })->name('wahana.detail');

    /*
    |--------------------------------------------------------------------------
    | ADMIN: DIPERBAIKI SESUAI awahana.blade.php ANDA
    |--------------------------------------------------------------------------
    */

    // 1. Login Page
    Route::get('/admin/login', fn() => view('admin.loginadmin'))->name('admin.login');

    // 2. Proses Login
    Route::post('/admin/login', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($request->email === 'admin@' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect('/admin/wahana')->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    })->name('admin.login.post');

    // 3. DASHBOARD: awahana.blade.php
    Route::get('/admin/wahana', function () use ($allWahana) {
        return view('admin.awahana', ['wahanaItems' => $allWahana]);
    })->name('admin.wahana');

    // 4. TAMBAH WAHANA
    Route::get('/admin/wahana/create', fn() => view('admin.tambahwahana'))->name('admin.wahana.create');
    Route::post('/admin/wahana/store', function (Request $request) {
        return redirect('/admin/wahana')->with('success', "Wahana '{$request->nama_wahana}' ditambahkan (simulasi).");
    })->name('admin.wahana.store');

    // 5. EDIT WAHANA — DIPERBAIKI: slug ASLI (bukan Str::slug)
    Route::get('/admin/wahana/edit/{slug}', function ($slug) use ($allWahana) {
        // Cari berdasarkan slug ASLI (seperti di awahana.blade.php)
        $wahana = collect($allWahana)->firstWhere('slug', $slug);

        if (!$wahana) {
            return redirect('/admin/wahana')->with('error', 'Wahana tidak ditemukan!');
        }

        return view('admin.editwahana', ['wahana' => $wahana]);
    })->name('admin.wahana.edit');

    // 6. UPDATE WAHANA
    Route::post('/admin/wahana/update/{slug}', function (Request $request, $slug) {
        $request->validate([
            'nama_wahana' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        return redirect('/admin/wahana')
            ->with('success', "Wahana '{$request->nama_wahana}' berhasil diperbarui (simulasi).");
    })->name('admin.wahana.update');

    // 7. LOGOUT
    Route::post('/admin/logout', function () {
        session()->forget('admin_logged_in');
        return redirect('/admin/login')->with('success', 'Logout berhasil.');
    })->name('admin.logout');

    // 8. DEBUG: LANGSUNG MASUK
    Route::get('/admin/debug', function () use ($allWahana) {
        session(['admin_logged_in' => true]);
        return redirect('/admin/wahana');
    });
});