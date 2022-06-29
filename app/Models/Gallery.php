<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static whereStatus(string $string)
 * @method static whereSlug(string $slug)
 * @property mixed $title
 * @property mixed $description
 * @property mixed $slug
 * @property mixed|string $public_id
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

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'public_id';
    }
}
