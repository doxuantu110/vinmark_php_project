<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
        'phone_number',
        'address',
        'avatar',
        'activation_token',
        'google_id'
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function shippingAdresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    //Check status

    public function isPending(){
        return $this->status === 'pending';
    }

    public function isActive(){
        return $this->status === 'active';
    }

    public function isBanned(){
        return $this->status === 'banned';
    }

    public function isDeleted(){
        return $this->status === 'deleted';
    }
}
