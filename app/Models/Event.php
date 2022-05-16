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
 * @property mixed $status
 * @property mixed|string $public_id
 * @method static orderByDesc(string $string)
 * @method static wherePublicId($public_id)
 * @method static whereStatus(string $EVENT_STATUS_ACTIVE)
 */
class Event extends Model
{
    use HasFactory;
}
