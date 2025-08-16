<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'provider_id',
        'category_id',
        'is_popular',
        'is_new',
        'is_active',
        'sort_order',
        'game_url'
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute()
    {
        return $this->image_url ?: 'https://via.placeholder.com/300x400?text=' . urlencode($this->name ?? 'Game');
    }



    public function getBadgesAttribute()
    {
        $badges = [];
        if ($this->is_new) $badges[] = 'new';
        if ($this->is_popular) $badges[] = 'popular';
        return $badges;
    }
}
