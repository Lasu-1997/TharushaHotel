<?php

namespace Modules\SystemCore\Entities;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolg extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_published',
    ];

    //boot method
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = strtolower(
                preg_replace('/\s+/', '-',
                    preg_replace('/[^A-Za-z0-9\-]/', '',
                        preg_replace('/-+/', '-',
                            trim($model->title, '-')
                        )
                    )
                )
            );
        });
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

}
