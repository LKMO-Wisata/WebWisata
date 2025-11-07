<?php

namespace App\Http\Controllers;

use App\Models\Wahana;

class WahanaPublicController extends Controller
{
    public function index()
    {
        // Menggunakan allWahana agar konsisten dengan apa yang mungkin Anda gunakan di view wahana.blade.php
        $allWahana = Wahana::where('is_active', true)
            ->orderBy('nama')
            ->paginate(12);

        return view('wahana', ['allWahana' => $allWahana]);
    }

    public function show(string $slug)
    {
        $wahanaDetail = Wahana::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $otherWahana = Wahana::where('is_active', true)
            // Pastikan tidak memilih wahana yang sedang dilihat
            ->where('id', '!=', $wahanaDetail->id) 
            ->inRandomOrder()
            ->take(3)
            ->get();

        // PERBAIKAN KRITIS DI SINI: Mengubah nama kunci (key) agar sesuai dengan yang diharapkan oleh View
        return view('wahana-detail', [
            'wahana' => $wahanaDetail, // View mengharapkan $wahana
            'others' => $otherWahana,  // View mengharapkan $others
        ]);
    }
}