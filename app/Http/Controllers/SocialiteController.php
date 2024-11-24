<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function login(){
        return Socialite::driver('github')->redirect();
    }

    
    public function callback(){
            $githubUser = Socialite::driver('github')->user();
          //  dd($githubUser);
        $user = User::updateOrCreate([
            'providor_id' => $githubUser->getId(),
        ],[
            'name' => $githubUser->getName(),
            'email' => $githubUser->getEmail(),
            'password' => $githubUser->getEmail(),
           
        ]);

        // auth
        Auth::login($user,true);


        return to_route('dashboard');

    }
}
