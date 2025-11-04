<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Mail;

Route::get('/test-mail', function () {
    try {
        Mail::raw('Hello from Laravel SMTP (Gmail App Password).', function ($m) {
            $m->to('alamatmu@contoh.com')->subject('SMTP Test');
        });
        return 'OK: Email dicoba kirim.';
    } catch (\Throwable $e) {
        \Log::error('MAIL ERROR: '.$e->getMessage());
        return 'ERROR: '.$e->getMessage();
    }
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/', fn() => redirect()->route('payment.form'));

Route::get('/payment', [PaymentController::class, 'create'])->name('payment.form');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/payment/success/{order}', [PaymentController::class, 'success'])->name('payment.success');