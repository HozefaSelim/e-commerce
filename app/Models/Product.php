<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','price','image',"category_id"];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')
                    ->withPivot('quantity');
    }


    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag');
    }

    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
    public function orders(){
        return $this->belongsToMany(Order::class,'product_order')->withPivot('quantity','price');
    } 

<<<<<<< HEAD

    

    public function variations(){
        return $this->hasMany(ProductVariation::class);
    }

    
=======
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
>>>>>>> df2c630 (update socialite)
}

