<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code','name','email','phone','payment_method','amount','currency','status','meta'
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}

