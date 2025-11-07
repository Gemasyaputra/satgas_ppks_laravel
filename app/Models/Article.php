<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'image_url',
        'author', // <-- Pastikan ini ada dari Tahap 8
        'category',
        'user_id', // Admin yg post
        'published_at',
    ];
}
