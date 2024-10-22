<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationOption extends Model
{
    use HasFactory;
    protected $fillable = ['name ', 'variation_id'];

    public function variation(){
        return $this->belongsTo(Variation::class);
    }
}
