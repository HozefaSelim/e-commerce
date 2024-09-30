<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Traits\ReturnTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ReturnTrait;

    public function register(UserRequest $request){
        $user = User::create($request->all());

       // $token = $user->createToken("auth_token")->plainTextToken;
       $token = auth()->attempt( $request->only('email','password'));
        return $this->returnData("token",$token,"welcome $user->name",200);
    }
    public function login(Request $request){

        // Sanctum way
    //     $user  = User::where("email",$request->email)->first();
    //     if(!$user){
    //         return $this->returnError("user not found");
    //     }

      
    //     if (!Hash::check($request->password, $user->password )){
    //         return $this->returnError("Worng password");
    //     
    //    $token = $user->createToken("auth_token")->plainTextToken;

    // JWT way
         $credentials = $request->only("email","password");
          $token = auth("api")->attempt($credentials);
        //  $token = Auth::guard('api')->attempt($credentials);
       
        return $this->returnData("token",$token,"welcome",200);
    }
    public function logout(Request $request){
            // Sanctum way
       // $request->user()->currentAccessToken()->delete();

           // JWT way
       auth()->logout();
        return $this->returnSuccess("You logged",200);
    }
}


