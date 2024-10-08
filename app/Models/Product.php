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



    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag');
    }

    public function brnad(){
        return $this->belongsTo(Brand::class);
    }

    public function wishlistByUser(){
        return $this->belongsToMany(User::class,'wishlists');
    }
}

