<?php

namespace App\Http\Controllers;

use App\Events\OrderUpdatedStatus;
use App\Models\Post;
use App\Models\User;
use App\Models\Order;
use App\Jobs\SendEmails;
use App\Mail\GreetingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Debugbar\Facades\Debugbar;

class UserController extends Controller
{

    public function getAllUsers (){
      //  $users = DB::table('users')->get();
        $users = User::all();
        return response()->json($users);
    }
    public function getUserById($id)
    {

        $userQueryBuilder = DB::table('users')->where('id', $id)->first();
    
        $userEloquent = User::find($id);
    
        return response()->json(
            $userQueryBuilder
        );
        
    }
    public function deleteUser($id)
{
    // باستخدام Query Builder
    DB::table('users')->where('id', $id)->delete();

    // باستخدام Eloquent ORM
    $user = User::find($id);
    if ($user) {
        $user->delete();
    }

    return response()->json(['message' => 'User deleted successfully']);
}

    




    public function index (){
        $users = User::all();
        return view("admin.showUsers")->with('users' , $users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

  
        // إعادة الاسم بحرف أول كبير عبر Accessor
        return response()->json(['name' => $user->name]);
    }

    // دالة لتخزين اسم المستخدم
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->save();

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function sendEmails(){
        $users = User::all();

        User::chunk(20,function($users){
            foreach($users as $user){
                dispatch(new SendEmails($user));
            }
        });
          

        return "Emails Sent successfully";
    }

    public function updatedstatuts(){

        $order = Order::find(5);
        
    broadcast(new OrderUpdatedStatus($order));
    }
}




