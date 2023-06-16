<?php

namespace Modules\SystemCore\Entities;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [];


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
