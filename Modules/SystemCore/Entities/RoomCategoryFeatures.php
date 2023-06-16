<?php

namespace Modules\SystemCore\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomCategoryFeatures extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_category_id',
        'icon_keyword',
        'feature',
        'description',
        'is_deleted',
    ];

    /**
     * @return BelongsTo
     */
    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategories::class, 'room_category_id');
    }

}
