<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'variety',
        'format',
        'price',
        'image',
        'available'
    ];
}