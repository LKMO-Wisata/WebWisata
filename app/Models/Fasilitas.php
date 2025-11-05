<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'gambar', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Supaya route model binding pakai slug
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // URL gambar yang aman (prioritas: http/https → public/img → storage)
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return asset('img/no-image.png');
        }

        if (str_starts_with($this->gambar, 'http://') || str_starts_with($this->gambar, 'https://')) {
            return $this->gambar;
        }

        if (str_starts_with($this->gambar, 'img/') || str_starts_with($this->gambar, '/img/')) {
            return asset(ltrim($this->gambar, '/')); // public/img/...
        }

        // default anggap path dari storage public
        return asset('storage/' . ltrim($this->gambar, '/'));
    }

    // Alias biar $item->gambar_url juga bisa dipakai di Blade lama
    public function getGambarUrlAttribute(): ?string
    {
        return $this->image_url;
    }
}
