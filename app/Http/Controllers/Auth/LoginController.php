<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showForm()
    {
        // Kalau sudah login, langsung ke dashboard admin
        if (Auth::check()) {
            return redirect()->route('admin.wahana.index');
        }
        return view('admin.loginadmin');
    }

    public function login(Request $request)
    {
        // throttle sederhana berdasarkan email + IP
        $this->ensureIsNotRateLimited($request);

        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ], [], [
            'email' => 'Email',
            'password' => 'Password',
        ]);

        // opsi remember me bisa ditambah nanti; default false
        $remember = false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            RateLimiter::clear($this->throttleKey($request));
            return redirect()->intended(route('admin.wahana.index'))->with('success', 'Selamat datang kembali 👋');
        }

        RateLimiter::hit($this->throttleKey($request), 60);

        throw ValidationException::withMessages([
            'email' => __('Email atau password salah.'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar.');
    }

    private function ensureIsNotRateLimited(Request $request): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));
        throw ValidationException::withMessages([
            'email' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik.",
        ]);
    }

    private function throttleKey(Request $request): string
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }
}
