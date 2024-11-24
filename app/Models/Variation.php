<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $fillable = ['name'];

    public function options(){
=======

    protected $fillable = ['name'];
    
    public function options()
    {
>>>>>>> df2c630 (update socialite)
        return $this->hasMany(VariationOption::class);
    }
}
