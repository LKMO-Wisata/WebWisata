<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FasilitasPublicController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\Admin\WahanaController as AdminWahanaController;
use App\Http\Controllers\WahanaPublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentController;
Route::get('/', fn() => view('homepage'))->name('homepage');
Route::get('/tiket', fn() => view('tiket'))->name('tiket');
Route::get('/form-tiket', [PaymentController::class, 'create'])->name('payment.form');
Route::post('/payments', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/pembayaran/{orderCode}', [PaymentController::class, 'success'])->name('payment.success');

// Route Fasilitas Publik (Menggunakan data $allFasilitas)
Route::get('/fasilitas', [FasilitasPublicController::class, 'index'])
    ->name('fasilitas');
// Route Wahana Publik (Menggunakan data $allWahana)
Route::get('/wahana', [WahanaPublicController::class, 'index'])->name('wahana');
Route::get('/wahana/{slug}', [WahanaPublicController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')   // hanya kebab-case aman
    ->name('wahana.detail');

Route::post('/feedback', fn()=>view('homepage'))->name('feedback.store');
/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login'); // tampilan form
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post'); // action form
});
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth') // <— lindungi semua admin dengan login
    ->group(function () {
        // Fasilitas
        Route::resource('fasilitas', \App\Http\Controllers\Admin\FasilitasController::class)->parameters([
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
        Route::resource('wahana', \App\Http\Controllers\Admin\WahanaController::class)->parameters([
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