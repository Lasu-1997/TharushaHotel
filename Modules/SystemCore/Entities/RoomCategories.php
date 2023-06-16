<?php

namespace Modules\SystemCore\Entities;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class RoomCategories extends Model
{
    use HasFactory;

    protected
        $fillable = [
        'name',
        'slug',
        'no_of_rooms',
        'available_rooms',
        'no_of_adults',
        'no_of_children',
        'charge_per_day',
        'description',
        'is_deleted',
    ];

    public
    static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = strtolower(
                preg_replace('/\s+/', '-',
                    preg_replace('/[^A-Za-z0-9\-]/', '',
                        preg_replace('/-+/', '-',
                            trim($model->name, '-')
                        )
                    )
                )
            );
        });
    }

    /**
     * @return HasMany
     */
    public
    function roomCategoryFeatures(): HasMany
    {
        return $this->hasMany(RoomCategoryFeatures::class, 'room_category_id');
    }

    //morphMany images
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @return HasMany
     */
    public
    function bookings(): HasMany
    {
        return $this->hasMany(Bookings::class, 'room_category_id');
    }

}
