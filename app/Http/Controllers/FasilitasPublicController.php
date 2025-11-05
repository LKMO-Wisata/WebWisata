<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasPublicController extends Controller
{
    // GET /fasilitas
    public function index()
    {
        $fasilitas = Fasilitas::where('is_active', true)->orderBy('nama')->get();
        return view('fasilitas', compact('fasilitas'));
    }
}
