<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scarves extends Model
{
    use HasFactory;

    /**
     * Get all email for webinars
     */
    public function images(): HasMany
    {
        return $this->hasMany(ScarvesImages::class, 'scarves_id');
    }
}
