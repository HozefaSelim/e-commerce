<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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

   

   

    public function editUser($id){
       
    }

    public function deleteUser($id){
        $user = User::find($id);
      $user->delete();
      //  $user->forceDelete();
        return redirect()->route('admin.users');
    }
}
