<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship with products (for shopkeepers)
    public function products()
    {
        return $this->hasMany(Product::class, 'shopkeeper_id');
    }

    // Relationship with customer orders
    public function customerOrders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    // Relationship with shopkeeper orders
    public function shopkeeperOrders()
    {
        return $this->hasMany(Order::class, 'shopkeeper_id');
    }

    // Relationship with shopkeeper profile
    public function shopkeeperProfile()
    {
        return $this->hasOne(ShopkeeperProfile::class);
    }
}
