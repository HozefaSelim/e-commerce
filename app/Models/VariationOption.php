<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationOption extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = ['name ', 'variation_id'];

    public function variation(){
=======
    protected $fillable = ['name', 'variation_id'];
    
    public function variation()
    {
>>>>>>> df2c630 (update socialite)
        return $this->belongsTo(Variation::class);
    }
}
