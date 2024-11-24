<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
<<<<<<< HEAD
        return $this->belongsToMany(Product::class)->withPivot('quantity','product_variation_id','options_ids');
=======
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'product_variation_id', 'options_ids');
>>>>>>> df2c630 (update socialite)
    }
    
}
