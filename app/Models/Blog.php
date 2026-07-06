<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'excerpt',
        'author',
        'status',
        'featured_image',
        'published_at',
        'meta_title',
        'meta_description',
    ];
}
