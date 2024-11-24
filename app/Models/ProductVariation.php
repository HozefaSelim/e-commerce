<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $fillable = ['Product_id ', 'option_ids' , 'price' ,'quantity'];

    protected $casts = [
            'option_ids' => 'array',
    ];

    public function options(){
        return $this->belongsToMany(VariationOption::class , 'product_variation_options' ,'product_variation_id' , 'variation_options_id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
=======
    protected $fillable = ['product_id', 'options_ids', 'price', 'quantity'];
    
    protected $casts = [
        'options_ids' => 'array',
    ];

    public function options()
{
    return $this->belongsToMany(VariationOption::class, 'product_variation_options', 'product_variation_id', 'variation_options_id');
}


    
>>>>>>> df2c630 (update socialite)
}
