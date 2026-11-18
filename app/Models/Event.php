<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'location',
        'start_date',
        'end_date',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Un événement possède plusieurs images.
     */
    public function images(): HasMany
    {
        return $this->hasMany(EventImage::class)
            ->orderBy('sort_order');
    }
}
