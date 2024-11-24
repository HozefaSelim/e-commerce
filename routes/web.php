<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Route::view('/product' , "product_details");
//Route::view('/products' , "products");
Route::view('/checkout' , "checkout");



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'verified' ]
    ], function(){ 
        Route::get('/', function () {
            return view('home');
        });
    
        Route::view('/checkout', "checkout");
        Route::resource('/products', ProductController::class);
        Route::get('/search', [ProductController::class, 'search'])->name('products.search');

      

        Route::middleware('auth')->group(function () {
            Route::post('products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

            
            Route::post('wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
            Route::post('wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
            Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

            
            Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

            // Add Product to Cart
            Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
            
            // Remove Product from Cart
            Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
            
            Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

            // Checkout (placeholder for now)
            Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

            Route::post('/create-checkout-session', [CheckoutController::class, 'createCheckoutSession'])->name('checkout.createSession');

            Route::get('/success', [CheckoutController::class, 'success'])->name('checkout.success');

            Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');


          
         Route::get('/orders',[OrderController::class,'index'])->name('order.index');
         
         
         
         
         
            // Apply Coupon
        Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

        // Remove Coupon
        Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');

        });

       
        
    }
    
);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




Route::middleware("admin")->prefix("/dashboard")->group(function () {
    
    Route::get("/" , function (){
        return view('dashboard');
    })->name("dashboard");
    Route::get('/users', [adminController::class, 'showUsers'])->name('admin.users');
    Route::get('/prodcuts', [adminController::class, 'showProducts'])->name('admin.products');
    Route::delete('/users/{id}', [adminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::put('/users/{id}', [adminController::class, 'editUser'])->name('admin.editUser');

});


Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);



Route::get('/users', [UserController::class, 'getAllUsers']);
//Route::get('/users/{id}', [UserController::class, 'getUserById']);
Route::delete('/users/{id}', [UserController::class, 'deleteUser']);

Route::get('/posts', [UserController::class, 'getAllPostsWithCommentsCount']);
Route::get('/post', [UserController::class, 'getPostsByIds']);

Route::get('/posts/performance', [UserController::class, 'comparePerformance']);

Route::get('/users/{user}/posts', [UserController::class, 'getUserPosts']);



Route::get('/sendEmails', [UserController::class, 'sendEmails']);


Route::get('/updatedstatuts', [UserController::class, 'updatedstatuts']);



Route::get('/github/redirect', [SocialiteController::class,'login'])->name('github.rediect');
 
Route::get('/github/callback', [SocialiteController::class,'callback'] )->name('github.callback');