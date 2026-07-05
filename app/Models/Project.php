<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'classification',
        'status',
        'progress_foundation',
        'progress_casting',
        'progress_finishing',
        'description',
        'body',
        'location',
        'address',
        'plot_size',
        'floors',
        'units',
        'size_range',
        'price_range',
        'handover_date',
        'rajuk_no',
        'amenities',
        'gallery',
        'cover_image',
        'visibility',
        'is_featured',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'amenities' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
    ];
}