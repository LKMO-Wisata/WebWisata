<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
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
            'deskripsi' => 'Bumper Blast adalah wahana adu seru mobil listrik yang dirancang khusus untuk pengunjung remaja dan dewasa. Setiap pengemudi dapat mengendalikan mobilnya di arena tertutup dan menabrakkan mobil lain dengan aman menggunakan sistem bemper pelindung tebal. Musik upbeat, lampu warna-warni, dan suara dentuman membuat suasana semakin seru dan kompetitif.',
            'ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: Minimal 130 cm untuk mengemudi sendiri','kapasitas per mobil: 1-2 orang (maksimum 150 kg total)']],
        ['nama' => 'Drop Tower',   'gambar' => 'img/wahana/wahana2.jpeg', 'slug' => 'Drop Tower',
            'deskripsi' => 'Drop Tower adalah wahana pemacu adrenalin yang membawa pengunjung naik ke puncak menara setinggi puluhan meter sebelum dijatuhkan dengan kecepatan tinggi secara tiba-tiba! Sensasi melayang seolah kehilangan gravitasi menjadikan wahana ini favorit bagi para pencinta tantangan ekstrem. Dari atas menara, pengunjung juga bisa menikmati pemandangan seluruh area taman sebelum terjun bebas ke bawah.',
            'ketentuan' => ['Usia: minimal 15 tahun', 'Tinggi badan: 130 -190 cm', 'Kesehatan: Tidak untuk yang memiliki masalah jantung, tekanan darah tinggi, atau kondisi medis tertentu', 'Berat maksimal: 100 kg','kapasitas per sesi: 12-16 orang']],
        ['nama' => 'Fantasy Voyage', 'gambar' => 'img/wahana/wahana3.jpeg', 'slug' => 'Fantasy Voyage',
            'deskripsi' => 'Fantasy Voyage adalah wahana perahu indoor penuh warna dan imajinasi di Zona Fantasi Cahaya. Pengunjung akan berlayar melewati dunia cahaya ajaib dengan karakter lucu, bangunan berkilau, dan musik ceria yang membawa suasana seperti negeri dongeng. Setiap area menggambarkan tema fantasi berbeda, dari kerajaan pelangi hingga hutan bintang',
            'ketentuan' => ['Usia: Semua umur (disarankan mulai 4 tahun ke atas)', 'Tinggi badan: Tidak ada batas minimum','Kapasitas per perahu: 6-8 orang']],
        ['nama' => 'Mini Bumper Blast','gambar' => 'img/wahana/wahana4.jpeg', 'slug' => 'Mini Bumper Blast',
            'deskripsi' => 'Mini Bumper Blast adalah versi anak-anak dari wahana bom-bom car klasik. Dirancang dengan ukuran mobil yang lebih kecil, kecepatan lebih aman, dan arena yang penuh warna, wahana ini memberikan pengalaman mengemudi seru dan aman untuk si kecil. Dengan lampu cerah, musik ceria, dan desain mobil lucu bergaya kartun, anak-anak bisa belajar mengendalikan arah sambil bermain dan tertawa bersama teman-teman mereka.',
            'ketentuan' => ['Usia: 4–10 tahun', 'Tinggi badan: Minimal 100 cm', 'Kapasitas per mobil: 1 anak', 'Durasi permainan: ±3 menit per sesi', 'Anak di bawah 7 tahun disarankan didampingi orang tua dari luar arena']],
        ['nama' => 'Mini Glowtopus Spin','gambar' => 'img/wahana/wahana5.jpeg', 'slug' => 'Mini Glowtopus Spin',
            'deskripsi' => 'Mini Glowtopus Spin adalah versi anak-anak dari wahana Glowtopus Spin yang penuh warna dan lampu neon. Wahana ini menghadirkan gurita raksasa lucu dengan tangan-tangan yang mengangkat dan memutar kursi mini berisi 2 anak di setiap lengannya. Gerakannya lembut dan berirama, ditemani musik ceria serta efek cahaya berwarna-warni yang membuat anak-anak merasa seperti sedang terbang di bawah laut bercahaya.',
            'ketentuan' => ['Usia: 4–10 tahun', 'Tinggi badan: Minimal 95 cm', 'Kapasitas kursi: 2 anak per kursi', 'Anak di bawah 7 tahun wajib didampingi orang tua dari luar area']],
        ['nama' => 'Pirate Ship',   'gambar' => 'img/wahana/wahana6.jpeg', 'slug' => 'Pirate Ship',
            'deskripsi' => 'Pirate Ship adalah wahana klasik berbentuk kapal bajak laut raksasa yang berayun maju-mundur dengan kecepatan tinggi! Saat kapal mulai bergerak perlahan, pengunjung akan merasakan sensasi ringan di perut, lalu semakin tinggi ayunan, adrenalin pun meningkat seolah sedang diterpa ombak besar di lautan lepas.',
            'ketentuan' => ['Usia: Minimal 10 tahun', 'Tinggi badan: Minimal 130 cm', 'Kapasitas: ±24 orang per sesi']],
        ['nama' => 'Rapid River Splash','gambar' => 'img/wahana/wahana7.jpeg', 'slug' => 'Rapid River Splash',
            'deskripsi' => 'Rapid River Splash adalah wahana arung jeram buatan yang membawa pengunjung menyusuri lintasan air penuh kejutan, mulai dari arus deras, gelombang buatan, air terjun mini, hingga tikungan tajam yang memacu adrenalin! Pengunjung duduk di atas perahu bundar besar yang berputar mengikuti arus, menciptakan pengalaman tak terduga di setiap sudutnya. Dengan efek percikan air dan semburan dari tebing buatan, wahana ini memberikan sensasi basah, seru, dan menegangkan sekaligus menyegarkan.',
            'ketentuan' => ['Usia: Minimal 10 tahun', 'Tinggi badan: Minimal 130 cm', 'Kapasitas per perahu: 6–8 orang', 'Durasi permainan: ±5–7 menit']],
        ['nama' => 'Rush Rider',   'gambar' => 'img/wahana/wahana8.jpeg', 'slug' => 'Rush Rider',
            'deskripsi' => 'Rush Rider adalah wahana roller coaster berkecepatan tinggi yang membawa pengunjung meluncur di jalur penuh tikungan tajam, tanjakan ekstrem, dan turunan vertikal yang memacu adrenalin. Terinspirasi dari energi dan kecepatan kilat, wahana ini memberikan sensasi melawan gravitasi dalam waktu singkat namun intens. Suara raungan rel dan hembusan angin menambah suasana mendebarkan sejak awal perjalanan hingga akhir lintasan.',
            'ketentuan' => ['Usia: Minimal 12 tahun', 'Tinggi badan: Minimal 135 cm', 'Kapasitas per kereta: 12–16 orang']],
        ['nama' => 'Sky Wheel',   'gambar' => 'img/wahana/wahana9.jpeg', 'slug' => 'Sky Wheel',
            'deskripsi' => 'Sky Wheel adalah wahana kincir ria yang menawarkan pengalaman menikmati pemandangan dari ketinggian dengan suasana santai dan menyenangkan. Setiap gondola berputar perlahan membawa pengunjung ke atas, memberikan panorama indah dari seluruh area taman bermain. Wahana ini dilengkapi dengan pencahayaan warna-warni yang menambah kesan estetis, terutama pada malam hari.',
            'ketentuan' => ['Usia: di atas 15 tahun', 'Tinggi badan: Minimal 140 cm', 'Kapasitas per gondola: 2 orang dewasa']],
        ['nama' => 'Swan Lake Paddle', 'gambar' => 'img/wahana/wahana10.jpeg', 'slug' => 'Swan Lake Paddle',
            'deskripsi' => 'Swan Lake Paddle adalah wahana perahu berbentuk angsa yang mengajak pengunjung berkeliling di danau buatan yang tenang dan indah. Dengan cara mengayuh pedal sendiri, pengunjung dapat menikmati pemandangan taman sambil bersantai di atas air. Desain perahunya yang elegan dan warna-warna lembut menjadikan wahana ini cocok untuk keluarga, pasangan, maupun anak-anak yang ingin menikmati suasana damai.',
            'ketentuan' => ['Usia: Minimal 7 tahun', 'Anak di bawah 15 tahun wajib didampingi orang dewasa', 'Kapasitas per perahu: 2 orang', 'Durasi permainan: ±10–15 menit']],
        ['nama' => 'Trampland',   'gambar' => 'img/wahana/wahana11.jpeg', 'slug' => 'Trampland',
            'deskripsi' => 'TrampoLand adalah wahana permainan yang dirancang untuk anak-anak dan remaja. Di sini, pengunjung bisa melompat bebas di atas trampolin raksasa yang saling terhubung. Wahana ini menawarkan sensasi menyenangkan sekaligus melatih keseimbangan, kelincahan, dan koordinasi tubuh. Dengan area yang luas dan aman, TrampoLand menjadi tempat favorit untuk melepas energi dan bersenang-senang bersama teman atau keluarga.',
            'ketentuan' => ['Usia: Minimal 5 tahun', 'Anak <7 tahun wajib didampingi orang tua', 'Tinggi badan: Minimal 100 cm']],
        ['nama' => 'Twinkle Carousel', 'gambar' => 'img/wahana/wahana12.jpeg', 'slug' => 'Twinkle Carousel',
            'deskripsi' => 'Twinkle Carousel adalah komidi putar klasik yang dipenuhi lampu berkilau dan musik lembut, menciptakan suasana dongeng yang hangat dan menyenangkan. Pengunjung dapat memilih menunggangi kuda, mobil, kereta, atau hewan fantasi berwarna pastel yang bergerak naik-turun seiring putaran lembut wahana. Dengan desain penuh ornamen keemasan dan lampu LED berbentuk bintang, wahana ini menjadi daya tarik utama bagi anak-anak dan keluarga yang ingin merasakan nostalgia masa kecil dalam suasana penuh cahaya dan keceriaan.',
            'ketentuan' => ['Usia: Semua umur (disarankan mulai 3 tahun ke atas) Anak di bawah 5 tahun wajib didampingi orang tua', 'Tinggi badan: Tidak ada batas minimum', 'Kapasitas: ±40 orang per sesi']],
    ];

    /*
    |--------------------------------------------------------------------------
    | ROUTE PUBLIK
    |--------------------------------------------------------------------------
    */
    Route::get('/test-mail', function () {
        try {
            Mail::raw('Hello from Laravel SMTP (Gmail App Password).', function ($m) {
                $m->to('alamatmu@contoh.com')->subject('SMTP Test');
            });
            return 'OK: Email dicoba kirim.';
        } catch (\Throwable $e) {
            Log::error('MAIL ERROR: '.$e->getMessage());
            return 'ERROR: '.$e->getMessage();
        }
    });

    Route::get('/', fn() => view('homepage'))->name('homepage');
    Route::get('/tiket', fn() => view('tiket'))->name('tiket');
    Route::get('/form-tiket', fn() => view('form-tiket'))->name('form-tiket');
    Route::get('/pembayaran', fn() => view('pembayaran'))->name('pembayaran');
    Route::get('/fasilitas', fn() => view('fasilitas'))->name('fasilitas');
    Route::get('/wahana', fn() => view('wahana'))->name('wahana');

    Route::get('/wahana/{slug}', function ($slug) use ($allWahana) {
        $wahanaDetail = collect($allWahana)->firstWhere(fn($w) => Str::slug($w['slug']) === Str::slug($slug));
        if (!$wahanaDetail) abort(404);

        $otherWahana = collect($allWahana)
            ->where(fn($w) => Str::slug($w['slug']) !== Str::slug($slug))
            ->take(3)
            ->values();

        return view('wahana-detail', compact('wahanaDetail', 'otherWahana'));
    })->name('wahana.detail');

    /*
    |--------------------------------------------------------------------------
    | ROUTE ADMIN (LOGIN + CRUD)
    |--------------------------------------------------------------------------
    */

    // Halaman Login
    Route::get('/admin/login', fn() => view('admin.loginadmin'))->name('admin.login');

    // Proses Login (admin@ + admin123)
    Route::post('/admin/login', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($request->email === 'admin@' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.wahana')->with('success', 'Login berhasil! Selamat datang, Admin.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    })->name('admin.login.post');

    // Semua route admin dilindungi
    Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () use ($allWahana) {

        // 1. READ (Halaman utama admin wahana)
        Route::get('/wahana', function () use ($allWahana) {
            return view('admin.awahana', [
                'wahanaItems' => $allWahana 
            ]);
        })->name('wahana');

        // 2. CREATE (Menampilkan form tambah BARU)
        Route::get('/wahana/create', function () {
            return view('admin.tambahwahana');
        })->name('wahana.create');

        // 3. CREATE (Memproses form tambah BARU)
        Route::post('/wahana/store', function (Request $request) {
            $nama = $request->input('nama_wahana');
            return redirect()->route('admin.wahana')
                             ->with('success', 'Wahana ' . $nama . ' berhasil ditambahkan (simulasi).');
        })->name('wahana.store');

        // 4. UPDATE (Menampilkan form edit)
        Route::get('/wahana/edit/{slug}', function ($slug) use ($allWahana) {
            $wahanaDetail = null;
            foreach ($allWahana as $w) {
                if (Str::slug($w['slug']) === Str::slug($slug)) {
                    $wahanaDetail = $w;
                    break;
                }
            }
            if (!$wahanaDetail) { abort(404); }
            return view('admin.editwahana', ['wahana' => $wahanaDetail]);
        })->name('wahana.edit');

        // 5. UPDATE (Memproses form edit)
        Route::post('/wahana/update/{slug}', function (Request $request, $slug) {
            $nama = $request->input('nama_wahana');
            return redirect()->route('admin.wahana')
                             ->with('success', 'Data wahana ' . $nama . ' berhasil diperbarui (simulasi).');
        })->name('wahana.update');

        // Logout
        Route::post('/logout', function () {
            session()->forget('admin_logged_in');
            return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
        })->name('logout');

    });

});