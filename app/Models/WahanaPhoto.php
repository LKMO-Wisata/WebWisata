<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WahanaPhoto extends Model
{
    protected $table = 'wahana_photos';
    protected $guarded = [];

    public function wahana()
    {
        return $this->belongsTo(Wahana::class, 'wahana_id');
    }
}
