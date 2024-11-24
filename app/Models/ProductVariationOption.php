<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationOption extends Model
{
    use HasFactory;

<<<<<<< HEAD
    public function variation(){
        return $this->belongsTo(ProductVariation::class);
    }
    public function product(){
        return $this->belongsTo(product::class);
=======
   
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
>>>>>>> df2c630 (update socialite)
    }
}
