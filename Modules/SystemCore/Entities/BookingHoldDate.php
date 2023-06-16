<?php

namespace Modules\SystemCore\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingHoldDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'description',
        'is_hold',
    ];

}
