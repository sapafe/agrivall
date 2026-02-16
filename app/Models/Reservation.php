<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'week_id', 'user_id', 'reserved_at', 'status'
    ];

    protected $casts = [
        'reserved_at' => 'datetime',
    ];
}
