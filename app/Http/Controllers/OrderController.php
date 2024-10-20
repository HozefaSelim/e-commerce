<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function index(){
        $user = Auth::user();

       $orders =  Order::where('user_id',$user->id)->get();

       return view('orders.index',compact('orders'));
    }
}
