<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Wahana extends Model
{
    use SoftDeletes;

    protected $table = 'wahana';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'ketentuan', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ketentuan' => 'array', // JSON -> array
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::saving(function (Wahana $w) {
            $w->slug = Str::slug($w->slug ?: $w->nama ?: '');
            // Unique slug
            $base = $w->slug; $i = 1;
            while (static::where('slug', $w->slug)->when($w->exists, fn($q)=>$q->where('id','!=',$w->id))->exists()) {
                $w->slug = $base.'-'.$i++;
            }
        });
    }

    // Relasi
    public function photos()
    {
        return $this->hasMany(WahanaPhoto::class)->orderBy('ordering');
    }

    public function primaryPhoto()
    {
        return $this->hasOne(WahanaPhoto::class)->where('is_primary', true)->orderBy('ordering');
    }

    // Helper URL (array)
    public function getPhotoUrlsAttribute(): array
    {
        return $this->photos->map(function ($p) {
            // Jika path diawali 'img/', anggap asset publik lama
            if (str_starts_with($p->path, 'img/')) {
                return asset($p->path);
            }
            // Selain itu anggap path di storage
            return asset('storage/'.$p->path);
        })->all();
    }

    // Satu URL utama
    public function getPrimaryPhotoUrlAttribute(): ?string
    {
        $p = $this->primaryPhoto()->first() ?? $this->photos()->first();
        if (!$p) return null;

        if (str_starts_with($p->path, 'img/')) return asset($p->path);
        return asset('storage/'.$p->path);
    }
}
