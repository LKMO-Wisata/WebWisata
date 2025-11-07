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
