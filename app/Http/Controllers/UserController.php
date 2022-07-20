<?php

namespace App\Http\Controllers;

use App\Models\PasswordReset;
use App\Models\Role;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
//use function Symfony\Component\String\u;


class UserController extends Controller
{
    public function store(Request $request ){

            try {

                $this->validate($request ,[
                    'firstname'=>'required|max:225',
                    "lastname"=>'required|max:225',
                    'email'=>'required|email|unique:user',
                    'phone'=>'required|digits:10|',
                    'location'=>"required|max:225",
                    'graphic_designer_role'=> 'required',
                    'password' => 'required| same:confirm_password|required:confirm_password| min:4| max:7 |',
                    'confirm_password' => 'min:4| max:7'

                ]);

                $checkDatabaseForUsers = User::all()->count();


    //           LETS VALIDATE USER'S INPUT

                 $user = new User();
                 $user["first_name"] = $request->firstname ;
                 $user["last_name"] = $request->lastname;
                 $user['email'] = $request->email;
                 $user['phone'] = $request->phone;
                 $user['location'] = $request->location;
                 $user['graphic_designer_role']= $request->graphic_designer_role ;


                 //HASH PASSWORD
                 $passwordHash = Hash::make($request->password);
                 $user['password'] = $passwordHash;
                 if($checkDatabaseForUsers == 0){
                     $user['role_id'] = 1 ;
                 }else{
                     $user['role_id'] = 2 ;
                 }


                 if($user->save()){
                     return (new ResponseController)->successResponse('Data saved Successfully' , $user);
                 }else{

                 }

            }catch (\Throwable $th){
                return (new ResponseController())->errorResponse("Incorrect / Incomplete data" , $th->errors());
            }


    }

    public function login(Request $request){
        try {
            $validate = $request->validate([
                'email' => 'required|email|max:255',
                'password'=> 'required|min:4|max:17'
            ]);

            if($validate){
                $email = $request->email ;
                $password = $request->password;

                if($user = User::where('email' , $email)->first()) {

                    if(Hash::check($password , $user->password)){
                        session(['Users' => $user->id]);
                        return (new ResponseController())->successResponse('Successfully logged in' , $user);
                    }else{
                        return (new ResponseController())->errorResponse("Email and password Does not match" , null);
                    }

                }else{
                    return (new ResponseController())->errorResponse('No user Found' , null);
                }
            }
        }catch (\Throwable $th){
            return (new ResponseController())->errorResponse("Incorrect / Incomplete data" , $th->errors());
        }
    }

    public function logout(Request $request){
        if(session("Users")){
            $request->session()->forget('Users');
            return (new ResponseController())->successResponse('Logout Successfully' , null);
        }
    }

    public function updateProfile(Request $request){
        //Profile update

        $validate =$request->validate([
            'first_name'=>'required|max:225',
            "last_name"=>'required|max:225',
            'phone'=>'required|digits:10|',
            'location'=>"required|max:225",
            'password' => 'required| min:4| max:7 |'
        ]);

        $user = User::find(session('loggeduser'))->first();

        $user["first_name"] = $request->first_name ;
        $user["last_name"] = $request->last_name;
        $user['phone'] = $request->phone;
        $user['location'] = $request->location;
        //HASH PASSWORD
        $passwordHash = Hash::make($request->password);
        $user['password'] = $passwordHash;

        $user->save();
        return (new ResponseController())->successResponse('Updated Successfully', '$user');

    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $checkUser = User::where('email', $request->email)->first();


        if ($checkUser) {
            //Generating Uri
            $url = URL::TemporarySignedRoute('CReset', now()->addMinute(10));

//            Adding the Uri and user id to password reset table
            $password_reset = PasswordReset::create([
                "uri_token" => $url,
                'user_id' => $checkUser->id,
            ]);

            //SEND MAIL TO USER HERE
            return (new ResponseController)->successResponse("Reset email sent successfully" , $url);


        }


    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @incoming data = password
     * this function takes the updates the password of the user
     */
    public function checkpasswordResetUri(Request $request)
        {
//            GET URL OF USER
            $full_url = $request->fullUrl();
            $password_reset = new PasswordReset() ;
//            CHECK IF URL EXISTS IN PASSWORD RESET TABLE
            $password_reset = $password_reset->where('uri_token', "$full_url")->first();
//            HASH INPUTED PASSWORD AND UPDATE PASSWORD OF USER
            $password = Hash::make($request->password);
            //Update Password in users table
            $user = User::find($password_reset->user_id);
            $user['password'] = $password ;
           if( $user->save()){
               return (new ResponseController())->successResponse("Password Updated Successfully", $user);
           }else{
               return (new ResponseController())->errorResponse("Password Unable to update" , null);
           }
        }





}




