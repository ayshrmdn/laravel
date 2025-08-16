<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'description',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];
}