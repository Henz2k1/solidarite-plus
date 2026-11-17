<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'content_key',
        'content_value',
        'type',
        'page',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Récupérer un contenu actif à partir de sa clé.
     */
    public static function getValue(
        string $key,
        ?string $default = null
    ): ?string {
        return static::query()
            ->where('content_key', $key)
            ->where('is_active', true)
            ->value('content_value') ?? $default;
    }
}
