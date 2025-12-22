<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'category_id', 'description', 'price', 'status', 'stock', 'unit'];

    protected $append = ['image_url', 'average_rating'];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function firstImage(){
        return $this->hasOne(ProductImage::class)->oldest('id');
    }

    public function getImageUrlAttribute(){
        return $this->firstImage?->image ? asset('storage/' . $this->firstImage->image): asset('storage/uploads/products/default-product.png');
    }
    public function getAverageRatingAttribute(){
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
