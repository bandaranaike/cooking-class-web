<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property false|mixed|string $image
 */
class GalleryImage extends Model
{
    use HasFactory;

    public function getSrcAttribute($image_name)
    {
        return "/storage/" . $image_name;
    }

    public function getThumbnailAttribute($image_name)
    {
        return "/storage/" . $image_name;
    }
}
