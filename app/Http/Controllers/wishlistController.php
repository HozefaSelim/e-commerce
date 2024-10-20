<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Models\Wishlist;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    // Add a product to the user's wishlist
    public function add(Product $product)
    {
        $user = Auth::user();
        
        // Check if the product is already in the wishlist
        if ($user->wishlist()->where('product_id', $product->id)->exists()) {
            return redirect()->back()->with('warning', 'Product already in wishlist!');
        }

        // Add the product to the wishlist
        $user->wishlist()->attach($product->id);
        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    // Remove a product from the user's wishlist
    public function remove(Product $product)
    {
        $user = Auth::user();
        
        // Remove the product from the wishlist
        $user->wishlist()->detach($product->id);
        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }

    // Display the user's wishlist
    public function index()
    {
        // Get the user's wishlist with products
        $wishlist = Auth::user()->wishlist; 
    
        return view('wishlist', compact('wishlist'));
    }
    
}
