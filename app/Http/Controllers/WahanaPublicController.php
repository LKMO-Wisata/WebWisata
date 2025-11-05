<?php

namespace App\Http\Controllers;

use App\Models\Wahana;

class WahanaPublicController extends Controller
{
    public function index()
    {
        $items = Wahana::where('is_active', true)
            ->orderBy('nama')
            ->paginate(12);

        return view('wahana', ['wahanaItems' => $items]);
    }

    public function show(string $slug)
    {
        $wahana = Wahana::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $other = Wahana::where('is_active', true)
            ->where('id', '!=', $wahana->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('wahana-detail', [
            'wahanaDetail' => $wahana,
            'otherWahana'  => $other,
        ]);
    }
}
