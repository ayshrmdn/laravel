<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'icon',
        'color',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }

    public function getImageAttribute()
    {
        return $this->image_url ?: 'https://via.placeholder.com/300x200?text=' . urlencode($this->name ?? 'Category');
    }

    public function getIconClassAttribute()
    {
        return $this->icon ?: 'fas fa-gamepad';
    }
}
