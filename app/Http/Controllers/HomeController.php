<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class HomeController extends Controller
{
    public function github(){
        //send the user's request to github
        return Socialite::driver('github')->redirect();
    }

    public function githubRedirect(){
//        get Oauth request back from github to authenticate the user

        $githubUser = Socialite::driver('github')->user();
        if($githubUser){
          $user =   User::firstOrCreate([
                'email', $githubUser->email
            ],[
                'email'=> $githubUser->email,
                'role_id' => 2,
                'account_type_id'=> 3
            ]);
          if($user){
//              session(['Users' => $user->id]);
              return 123;
          }else{
              return "false";   
          }

        }

    }

    public function googleLogin(){
        //send The user request to github
        return Socialite::driver('google')->redirect();
    }
    public function googleRedirect(){
        // get oauth request back from google
        try{
            $googleUser = Socialite::driver('google')->user();
            $user = User::firstOrCreate([
                'email'=> $googleUser->email
            ],[
                'email'=> $googleUser->email,
                'role_id' => 2,
                'account_type_id'=> 2

            ]);

            if($user){
                return 123 ;
            }else{
                return 'false';
            }
        }catch(Throwable $th){
            return redirect()->back();
        }

    }
}
