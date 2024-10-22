<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationOption extends Model
{
    use HasFactory;

    public function variation(){
        return $this->belongsTo(ProductVariation::class);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }
}
