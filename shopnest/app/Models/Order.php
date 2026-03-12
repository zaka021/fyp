<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'shopkeeper_id',
        'product_id',
        'order_number',
        'quantity',
        'unit_price',
        'total_amount',
        'status',
        'delivery_address',
        'customer_phone',
        'notes',
        'delivered_at',
        'rating',
        'feedback',
        'feedback_at',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'delivered_at' => 'datetime',
        'feedback_at' => 'datetime',
    ];

    // Relationship with customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relationship with shopkeeper
    public function shopkeeper()
    {
        return $this->belongsTo(User::class, 'shopkeeper_id');
    }

    // Relationship with product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Generate unique order number
    public static function generateOrderNumber()
    {
        return 'VSN-' . strtoupper(uniqid());
    }
}
