<?php

namespace Modules\SystemCore\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'id_type',
        'id_number',
        'room_category_id',
        'check_in',
        'check_out',
        'no_of_adults',
        'no_of_children',
        'no_of_rooms',
        'booking_confirmed',
        'charge',
        'discount',
        'total_to_pay',
        'payment_method',
        'payment_status',
        'status',
        'is_deleted',
    ];

    /**
     * @return BelongsTo
     */
    public function roomCategory(): BelongsTo
    {
        return $this->belongsTo(RoomCategories::class, 'room_category_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

    /**
     * @param $value
     * @return string
     */
    public function getCheckInAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    /**
     * @param $value
     * @return string
     */
    public function getCheckOutAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    /**
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }


}
