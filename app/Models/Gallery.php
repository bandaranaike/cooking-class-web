<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static whereStatus(string $string)
 * @method static whereSlug(string $slug)
 */
class Gallery extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }
}
