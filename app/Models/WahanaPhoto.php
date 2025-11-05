<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WahanaPhoto extends Model
{
    protected $table = 'wahana_photos';

    protected $fillable = [
        'wahana_id', 'path', 'ordering', 'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'ordering' => 'integer',
    ];

    public function wahana()
    {
        return $this->belongsTo(Wahana::class);
    }

    public function getUrlAttribute(): string
    {
        return str_starts_with($this->path, 'img/')
            ? asset($this->path)
            : asset('storage/'.$this->path);
    }
}
