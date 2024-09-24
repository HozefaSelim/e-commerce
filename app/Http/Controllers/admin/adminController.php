<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function showUsers(){
        //$users = User::withTrashed()->where('role','user')->get();
      //  $users = User::onlyTrashed()->where('role','user')->get();
     //  User::withTrashed()->find(8)->restore();
               $users = User::where('role','user')->get();
        return view('admin.users')->with('users',$users);
    }
    public function showProducts(Request $request){


      
      // $products = Product::with('category')->get();
       $query = Product::query();

       // filter with category
     if($request->has('category_id') && $request->input('category_id')){
      $query->where('category_id',$request->input('category_id'));
     }

     // filter with price
     if($request->has('order') && $request->input('order')){
      
      $query->orderBy('price',$request->input('order'));
     }

     Debugbar::info($request->input('order'));


     $products = $query->get();
      $categories = Category::all();
      
      return view('admin.products',compact('products','categories'));
  }

 
   

   

    public function editUser($id){
       
    }

    public function deleteUser($id){
        $user = User::find($id);
      $user->delete();
      //  $user->forceDelete();
        return redirect()->route('admin.users');
    }
}
