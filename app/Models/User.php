<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
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

    public function getAvatarUrlAttribute(){
    return $this->avatar 
        ? asset('storage/' . $this->avatar) 
        : asset('storage/uploads/users/default-avatar.png');
    }

}
