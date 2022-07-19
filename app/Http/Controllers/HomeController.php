<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function github(){
        //send the user's request to github
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(){
//        get Oauth request back from github to authenticate the user

        $gitUser = Socialite::driver('github')->user();
        $user = User::firstOrCreate([
            'email' => $gitUser->email
        ],[
            'email'=> $gitUser->email,
            
        ]
    );

    }

    public function googleLogin(){
        //send The user request to github
        return Socialite::driver('google')->redirect();
    }
    public function googleRedirect(){
        // get oauth request back from google
        $googleUser = Socialite::driver('google')->user();
        
    }
}
