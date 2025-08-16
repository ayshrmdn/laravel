<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo_url',
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



    public function getLogoAttribute()
    {
        return $this->logo_url ?: 'https://via.placeholder.com/150x80?text=' . urlencode($this->name ?? 'P');
    }
}
