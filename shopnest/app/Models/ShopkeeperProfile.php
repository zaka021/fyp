<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopkeeperProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'store_description',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'delivery_radius',
        'delivery_fee',
        'opening_time',
        'closing_time',
        'working_days',
        'notifications_enabled',
        'email_notifications',
        'sms_notifications',
        'store_logo',
        'store_banner',
    ];

    protected $casts = [
        'working_days' => 'array',
        'notifications_enabled' => 'boolean',
        'email_notifications' => 'boolean',
        'sms_notifications' => 'boolean',
        'delivery_radius' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOpenNow()
    {
        $now = now();
        $currentDay = strtolower($now->format('l'));
        $currentTime = $now->format('H:i:s');

        return in_array($currentDay, $this->working_days) &&
               $currentTime >= $this->opening_time &&
               $currentTime <= $this->closing_time;
    }
}
