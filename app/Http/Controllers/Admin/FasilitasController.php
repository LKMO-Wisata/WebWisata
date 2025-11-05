<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class FasilitasController extends Controller
{
    // GET /admin/fasilitas
    public function index()
    {
        $items = Fasilitas::latest()->paginate(12);
        return view('admin.aturfasilitas', [
            'fasilitasItems' => $items,
        ]);
    }

    // GET /admin/fasilitas/create
    public function create()
    {
        return view('admin.tambahfasilitas');
    }

    // POST /admin/fasilitas
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => ['required','string','max:150'],
            'slug'       => ['nullable','string','max:180','unique:fasilitas,slug'],
            'deskripsi'  => ['nullable','string'],
            'gambar'     => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'is_active'  => ['nullable','boolean'],
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $data['is_active'] = (bool) ($data['is_active'] ?? true);

        Fasilitas::create($data);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    // GET /admin/fasilitas/{fasilita}/edit  (route model binding pakai slug)
    public function edit(Fasilitas $fasilita)
    {
        return view('admin.editfasilitas', ['fasilitas' => $fasilita]);
    }

    // PUT/PATCH /admin/fasilitas/{fasilita}
    public function update(Request $request, Fasilitas $fasilita)
    {
        $data = $request->validate([
            'nama'       => ['required','string','max:150'],
            'slug'       => ['nullable','string','max:180','unique:fasilitas,slug,'.$fasilita->id],
            'deskripsi'  => ['nullable','string'],
            'gambar'     => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'is_active'  => ['nullable','boolean'],
        ]);

        if ($request->hasFile('gambar')) {
            // hapus lama
            if ($fasilita->gambar && Storage::disk('public')->exists($fasilita->gambar)) {
                Storage::disk('public')->delete($fasilita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('fasilitas', 'public');
        }

        $data['is_active'] = (bool) ($data['is_active'] ?? $fasilita->is_active);

        $fasilita->update($data);

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    // DELETE /admin/fasilitas/{fasilita}
    public function destroy(Fasilitas $fasilita)
    {
        if ($fasilita->gambar && Storage::disk('public')->exists($fasilita->gambar)) {
            Storage::disk('public')->delete($fasilita->gambar);
        }

        $fasilita->delete();

        return redirect()->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
