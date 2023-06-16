<?php

namespace Modules\SystemCore\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SitePreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_us',
        'mission_vision',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'phone',
        'email',
    ];

}
