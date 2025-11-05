<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wahana;
use App\Models\WahanaPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WahanaController extends Controller
{
    public function index()
    {
        $items = Wahana::latest()->paginate(12);
        return view('admin.awahana', [ // pakai view admin milikmu untuk daftar wahana
            'wahanaItems' => $items,
        ]);
    }

    public function create()
    {
        return view('admin.tambahwahana');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => ['required','string','max:150'],
            'slug'       => ['nullable','string','max:180','unique:wahana,slug'],
            'deskripsi'  => ['nullable','string'],
            'ketentuan'  => ['nullable','array'],        // kirim sebagai array[] di form
            'ketentuan.*'=> ['nullable','string','max:255'],
            'is_active'  => ['nullable','boolean'],
            'gambar'     => ['nullable','array'],        // multiple files input name="gambar[]"
            'gambar.*'   => ['image','mimes:jpg,jpeg,png,webp','max:4096'],
        ]);

        DB::transaction(function () use ($request, $data) {
            $data['is_active'] = (bool) ($data['is_active'] ?? true);

            $wahana = Wahana::create([
                'nama' => $data['nama'],
                'slug' => $data['slug'] ?? null,
                'deskripsi' => $data['deskripsi'] ?? null,
                'ketentuan' => $data['ketentuan'] ?? [],
                'is_active' => $data['is_active'],
            ]);

            // Upload foto (opsional). Jika tidak upload, tetap bisa pakai asset public hasil seeder.
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $i => $file) {
                    $path = $file->store('wahana', 'public'); // simpan di storage
                    $wahana->photos()->create([
                        'path' => $path,
                        'ordering' => $i,
                        'is_primary' => $i === 0,
                    ]);
                }
            }
        });

        return redirect()->route('admin.wahana.index')->with('success', 'Wahana berhasil ditambahkan.');
    }

    public function edit(Wahana $wahana)
    {
        // Menampilkan form edit + daftar foto
        return view('admin.editwahana', ['wahana' => $wahana]);
    }

    public function update(Request $request, Wahana $wahana)
    {
        $data = $request->validate([
            'nama'       => ['required','string','max:150'],
            'slug'       => ['nullable','string','max:180','unique:wahana,slug,'.$wahana->id],
            'deskripsi'  => ['nullable','string'],
            'ketentuan'  => ['nullable','array'],
            'ketentuan.*'=> ['nullable','string','max:255'],
            'is_active'  => ['nullable','boolean'],
            'gambar'     => ['nullable','array'],        // tambahan foto baru (opsional)
            'gambar.*'   => ['image','mimes:jpg,jpeg,png,webp','max:4096'],
            'primary_photo_id' => ['nullable','integer','exists:wahana_photos,id'],
            'delete_photo_ids' => ['nullable','array'],  // id foto yang mau dihapus
            'delete_photo_ids.*' => ['integer','exists:wahana_photos,id'],
        ]);

        DB::transaction(function () use ($request, $wahana, $data) {
            $wahana->update([
                'nama' => $data['nama'],
                'slug' => $data['slug'] ?? $wahana->slug,
                'deskripsi' => $data['deskripsi'] ?? null,
                'ketentuan' => $data['ketentuan'] ?? [],
                'is_active' => (bool) ($data['is_active'] ?? $wahana->is_active),
            ]);

            // Hapus foto tertentu (hanya yang disimpan di storage, bukan asset public 'img/..')
            if (!empty($data['delete_photo_ids'])) {
                $photos = WahanaPhoto::whereIn('id', $data['delete_photo_ids'])
                    ->where('wahana_id', $wahana->id)->get();

                foreach ($photos as $p) {
                    if (!str_starts_with($p->path, 'img/')) { // jangan hapus file asset publik lama
                        if (Storage::disk('public')->exists($p->path)) {
                            Storage::disk('public')->delete($p->path);
                        }
                    }
                    $p->delete();
                }
            }

            // Upload foto tambahan
            if ($request->hasFile('gambar')) {
                $start = (int) ($wahana->photos()->max('ordering') ?? 0) + 1;
                foreach ($request->file('gambar') as $i => $file) {
                    $path = $file->store('wahana', 'public');
                    $wahana->photos()->create([
                        'path' => $path,
                        'ordering' => $start + $i,
                        'is_primary' => false,
                    ]);
                }
            }

            // Set primary photo
            if (!empty($data['primary_photo_id'])) {
                $wahana->photos()->update(['is_primary' => false]);
                $wahana->photos()->where('id', $data['primary_photo_id'])->update(['is_primary' => true]);
            }
        });

        return redirect()->route('admin.wahana.index')->with('success', 'Wahana berhasil diperbarui.');
    }

    public function destroy(Wahana $wahana)
    {
        // Hapus file foto storage saja (bukan asset public)
        foreach ($wahana->photos as $p) {
            if (!str_starts_with($p->path, 'img/')) {
                if (Storage::disk('public')->exists($p->path)) {
                    Storage::disk('public')->delete($p->path);
                }
            }
        }
        $wahana->delete();

        return redirect()->route('admin.wahana.index')->with('success', 'Wahana berhasil dihapus.');
    }
}
