<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{

    public function add(Product $product){

    $user = Auth::user();
        if ($user->wishlist()->where('product_id' ,$product->id )->exists()){

            return redirect()->back()->with('error' , 'this product already exist');
        }

        $user->wishlist()->attach($product);
        
        return redirect()->back()->with('error' , 'this product added to your wishlist');;
    }
}


