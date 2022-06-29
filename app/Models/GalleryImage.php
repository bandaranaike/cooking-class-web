<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property false|mixed|string $image
 * @property false|mixed|string $public_id
 */
class GalleryImage extends Model
{
    use HasFactory;

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'public_id';
    }
}
