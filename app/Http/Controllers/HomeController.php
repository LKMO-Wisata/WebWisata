<?php

namespace App\Http\Controllers;

use App\Models\Wahana;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $table = (new Wahana)->getTable();
        $hasIsActive = Schema::hasColumn($table, 'is_active');

        $query = Wahana::query()->with(['primaryPhoto', 'photos']);

        if ($hasIsActive) {
            $query->where('is_active', true);
        }

        $wahana = $query
            ->latest('id')
            ->take(12)
            ->get(['id', 'nama', 'slug']); // <= tidak ambil 'gambar' lagi

        // Siapkan data siap pakai untuk slider homepage
        $wahanaCards = $wahana->map(fn ($w) => [
            'nama'       => $w->nama,
            'slug'       => $w->slug,
            'gambar_url' => $w->primary_photo_url, // dari accessor
        ])->values();

        return view('homepage', compact('wahanaCards'));
    }
}
