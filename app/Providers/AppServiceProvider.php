<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist; 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.nav', function ($view) {
            $cartItems = collect();  // Initialize an empty collection
            $wishlistCount = 0;  
            $orderCount  = 0;
            $categories = Category::all();
        
            if (Auth::check()) {
                $cart = Auth::user()->cart;  // Assuming each user has one cart
                if ($cart) {
                    // No need for `with('product')`
                    $cartItems = $cart->products()->get(); // Fetch all products in the cart
                }
                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

                $user = Auth::user();

                $orderCount = Order::where('user_id',$user->id)->count();
            }
        
            $view->with([
                'cartItems' => $cartItems,
                'wishlistCount' => $wishlistCount, 
                'categories' => $categories,
                'orderCount' => $orderCount,
            ]);
        });
        
        
    }
}


