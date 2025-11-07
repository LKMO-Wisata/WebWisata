<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FasilitasPublicController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\Admin\WahanaController as AdminWahanaController;
use App\Http\Controllers\WahanaPublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentController;

// Homepage lewat controller agar data wahana diambil dari DB
Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Ticketing (sudah kamu punya)
Route::get('/tiket', fn() => view('tiket'))->name('tiket');
Route::get('/form-tiket', [PaymentController::class, 'create'])->name('payment.form');
Route::post('/payments', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/pembayaran/{orderCode}', [PaymentController::class, 'success'])->name('payment.success');

// Fasilitas & Wahana publik
Route::get('/fasilitas', [FasilitasPublicController::class, 'index'])->name('fasilitas');
Route::get('/wahana', [WahanaPublicController::class, 'index'])->name('wahana');
Route::get('/wahana/{slug}', [WahanaPublicController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('wahana.detail');

// Feedback publik
Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        // Rekap order tiket (sudah dari kamu)
        Route::get('/tiket', [PaymentController::class, 'index'])->name('tiket.index');
        Route::post('/tiket', [PaymentController::class, 'update'])->name('tiket.update');

        // Feedback admin
        Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

        // Fasilitas
        Route::resource('fasilitas', AdminFasilitasController::class)->parameters([
            'fasilitas' => 'fasilita'
        ])->names([
            'index'   => 'fasilitas.index',
            'create'  => 'fasilitas.create',
            'store'   => 'fasilitas.store',
            'edit'    => 'fasilitas.edit',
            'update'  => 'fasilitas.update',
            'destroy' => 'fasilitas.destroy',
        ]);

<<<<<<< HEAD
        // Wahana
        Route::resource('wahana', AdminWahanaController::class)->parameters([
            'wahana' => 'wahana'
        ])->names([
            'index'   => 'wahana.index',
            'create'  => 'wahana.create',
            'store'   => 'wahana.store',
            'edit'    => 'wahana.edit',
            'update'  => 'wahana.update',
            'destroy' => 'wahana.destroy',
            'show'    => 'wahana.show',
        ]);

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });
=======
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
// routes/web.php

Route::get('/wahana/{slug}', function ($slug) use ($allWahana) {
    // PERBAIKAN: Langsung bandingkan $w['slug'] dengan $slug.
    // Membandingkan "Bumper Cars" (data) === "Bumper Cars" (URL) -> BERHASIL
    $wahanaDetail = collect($allWahana)->firstWhere(fn($w) => $w['slug'] === $slug); 
    
    if (!$wahanaDetail) abort(404); // Ini sudah benar
    
    // PERBAIKAN: Bagian "otherWahana" juga harus diperbaiki
    $otherWahana = collect($allWahana)->where(fn($w) => $w['slug'] !== $slug)->values(); 
    
    return view('wahana-detail', [
        'wahana' => $wahanaDetail, 
        'others' => $otherWahana
    ]);
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
>>>>>>> 19aa3f4677b3add52025ebd28b0172dc2818379c
