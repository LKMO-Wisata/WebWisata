<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wahana extends Model
{
    use SoftDeletes;

    protected $table = 'wahana';
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'ketentuan' => 'array', // <-- TAMBAHKAN BARIS INI
        'is_active' => 'boolean',
    ];

    public function photos()
    {
        return $this->hasMany(WahanaPhoto::class, 'wahana_id');
    }

    public function primaryPhoto()
    {
        return $this->hasOne(WahanaPhoto::class, 'wahana_id')->where('is_primary', true);
    }

    /**
     * URL foto utama (fallback ke foto pertama, lalu ke placeholder).
     */
    public function getPrimaryPhotoUrlAttribute(): string
    {
        $photo = $this->primaryPhoto()->first() ?? $this->photos()->orderBy('ordering')->orderBy('id')->first();

        if (!$photo) {
            return asset('img/no-image.png');
        }

        $path = $photo->path;
        // http/https langsung pakai
        if (preg_match('#^https?://#i', $path)) {
            return $path;
        }
        // file di public/img
        if (str_starts_with($path, 'img/') || str_starts_with($path, '/img/')) {
            return asset(ltrim($path, '/'));
        }
        // default: storage (public disk)
        return asset('storage/' . ltrim($path, '/'));
    }
}