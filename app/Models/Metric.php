<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $fillable = [
        'label',
        'value',
        'suffix',
        'icon',
        'sort_order',
    ];
}
