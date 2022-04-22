<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $date
 * @property mixed $number_of_pax
 * @property mixed $url
 * @property mixed $description
 * @property mixed $title
 * @property mixed $image
 */
class Event extends Model
{
    use HasFactory;
}
