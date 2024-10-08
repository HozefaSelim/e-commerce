<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

//Route::view('/product' , "product_details");
//Route::view('/products' , "products");
Route::view('/checkout' , "checkout");


Route::resource('/products',ProductController::class);
Route::get('/search',[ProductController::class,'search'])->name('products.search');


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