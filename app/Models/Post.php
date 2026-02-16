<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post_type_id',
        'title',
        'body',
        'published_at',
        'image',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function type()
    {
        return $this->belongsTo(PostType::class, 'post_type_id');
    }
}
