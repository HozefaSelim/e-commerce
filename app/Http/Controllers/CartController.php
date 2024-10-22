<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\ProductVariation;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add product to cart
  // View Cart
  public function index()
{
    $cartItems = Auth::user()->cart->products()->get(); 
 
    foreach($cartItems  as $item){
        $selectedOptions = json_decode($item->pivot->options_ids , true);

        $selectedVariations = [];
        if($selectedOptions){
            foreach( $selectedOptions  as $optionId){
                $option = VariationOption::with('variation')->find($optionId);
                if($option){
                    $selectedVariations[] = [
                        'variaion_name' => $option->variation->name,
                        'option_name' => $option->name,
                        'option_id' => $option->id,
                    ];
                }
            }
        }
        $item->setAttribute('selected_variations' ,  $selectedVariations );
       
    }
   // dd($cartItems);

    return view('cart.index', compact('cartItems'));
    }

  // Add Product to Cart
  public function add(Product $product, Request $request)
  {
      $cart = Auth::user()->cart ?: Auth::user()->cart()->create(); // Get or create the cart
      

    $selectedOptions = $request->input('variation');
    //dd($selectedOptions);

    $productVariation = ProductVariation::where('product_id',$product->id)->where(function ($query) use ($selectedOptions){
        foreach($selectedOptions as $optionId){
            $query->whereJsonContains('options_ids',$optionId);
        }
    })->first();

    if(!$productVariation){
      return redirect()->back()->with('error', 'This variation are not exists');
    }
      $cartProduct = $cart->products()
      ->where('product_id',$product->id)
      ->wherePivot('product_variation_id' , $productVariation->id)
      ->wherePivot('options_ids' , json_encode(  $selectedOptions))->first();

      if ($cartProduct) {
          // If product exists, increase the quantity
          $productVariation->pivot->quantity += $request->quantity;
          $productVariation->pivot->save();
      } else {
          // Add the product to the cart with the given quantity
          $cart->products()->attach($product->id, [
            'quantity' => $request->quantity ,
            'product_variation_id' => $productVariation->id,
            'options_ids' => json_encode(  $selectedOptions)
        ]);
      }

      return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
  }
  // Remove Product from Cart
  public function remove(Product $product)
  {
      $cart = Auth::user()->cart;

      if ($cart) {
          $cart->products()->detach($product->id); // Remove the product from the cart
      }

      return redirect()->back()->with('success', 'Product removed from cart');
  }
  public function update(Request $request, $productId)
  {
      $request->validate([
          'quantity' => 'required|integer|min:1',
      ]);
  
      $cart = Auth::user()->cart;
      $cartProduct = $cart->products()->where('product_id', $productId)->first();
  
      if ($cartProduct) {
          // Update the quantity with the input from the form
          $cartProduct->pivot->quantity = $request->input('quantity');
          $cartProduct->pivot->save();
      }
  
      return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
  }
  
  
  // Checkout (Placeholder)
  public function checkout()
  {

     $cartItems = Auth::user()->cart->products()->get(); 

    $totalPrice =  $cartItems->sum(function($item){
        return $item->price * $item->pivot->quantity;
     });
      return view('cart.checkout' , compact('cartItems' , 'totalPrice'));
  }

  public function applyCoupon(Request $request)
    {
            $request->validate([
                'coupon_code' => 'required|string'
            ]);

            $couponCode = $request->input('coupon_code');

            // Let's assume you have a model Coupon to check valid codes
            $coupon = Coupon::where('code', $couponCode)->first();

            if (!$coupon) {
                return redirect()->back()->with('error', 'Invalid coupon code.');
            }

            // Assume the coupon provides a fixed discount, e.g., $50
            $discount = $coupon->discount_amount;

            // Store the discount in the session
            session()->put('discount', $discount);

            return redirect()->back()->with('success', 'Coupon applied successfully!');
                }
        public function removeCoupon()
        {
            session()->forget('discount');
            return redirect()->back()->with('success', 'Coupon removed successfully.');
        }

}
