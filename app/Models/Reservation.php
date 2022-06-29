<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $email
 * @property mixed $phone
 * @property string $date
 * @property float $time
 * @property integer $number_of_pax
 * @property string $comment
 * @property mixed|string $public_id
 */
class Reservation extends Model
{
    use HasFactory;
}
