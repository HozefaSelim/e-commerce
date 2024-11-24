<?php

namespace App\Http\Controllers;
use App\Jobs\OrderTakenJob;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function createCheckoutSession(){
      

        Stripe::setApiKey(config('stripe.secret'));

        $cartItems = Auth::user()->cart->products()->get(); 

        $lineItems = [];

        foreach( $cartItems as $item){
            $lineItems[] = [
                'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                  'name' => $item->name_en,
                ],
                'unit_amount' => $item->price * 100,
              ],
              'quantity' => $item->pivot->quantity,
            ];
        }

        $checkout_session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
          ]);

          return redirect($checkout_session->url);
    }

    public function success(){
        
        $user = Auth::user();
        $cart = $user->cart;

        if($cart && $cart->products()->count() > 0){


            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $cart->products->sum(function($item){
                    return $item->price * $item->pivot->quantity;
                }),
                'status' => 'paid' // pending -.....
            ]);
            
            foreach($cart->products as $product){
                $order->prodcuts()->attach($product->id , [
                    'quantity' => $product->pivot->quantity,
                    'price' => $product->price,

                ]);
            }
            $cart->products()->detach();

            dispatch(new OrderTakenJob($order ));
            
            return view('cart.success')->with('success',"your payment has been successfult done");
        }
        
        return view('cart.index')->with('error',"your cart is empty");
       
    }


    public function cancel(){
        return view('cart.cancel')->with('error',"payment was canceled");
    }
    
}
