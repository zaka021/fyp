<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'shopkeeper_id',
        'product_id',
        'message',
        'sender_type',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function shopkeeper()
    {
        return $this->belongsTo(User::class, 'shopkeeper_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Get latest message for each customer-shopkeeper pair
    public static function getLatestChatsForShopkeeper($shopkeeperId)
    {
        return self::where('shopkeeper_id', $shopkeeperId)
            ->with(['customer', 'product'])
            ->selectRaw('customer_id, MAX(id) as latest_id')
            ->groupBy('customer_id')
            ->get()
            ->map(function ($item) {
                return self::with(['customer', 'product'])->find($item->latest_id);
            });
    }

    // Get unread count for shopkeeper
    public static function getUnreadCountForShopkeeper($shopkeeperId)
    {
        return self::where('shopkeeper_id', $shopkeeperId)
            ->where('sender_type', 'customer')
            ->where('is_read', false)
            ->count();
    }

    // Get conversation between customer and shopkeeper
    public static function getConversation($customerId, $shopkeeperId)
    {
        return self::where('customer_id', $customerId)
            ->where('shopkeeper_id', $shopkeeperId)
            ->with(['customer', 'shopkeeper', 'product'])
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
