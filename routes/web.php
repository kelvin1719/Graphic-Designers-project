<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('', function () {
//    return view('welcome');
//});

Route::get('/' , function(){
    return view('home');
})->name('home');
Route::get('signup' , function(){
    return view('signup');
})->name('signup');

Route::get('portfolio' , function(){
   return view('portfolio');
})->name('portfolio');

Route::get('logout' , [UserController::class , 'logout'])->name('logout');

Route::get('sign-in/github' , [HomeController::class , 'github' ])->name('github');
Route::get('sign-in/github/redirect' , [HomeController::class , 'githubRedirect']);


Route::get('google/sign-in' , [HomeController::class , 'googleLogin'])->name('google-login');
Route::get('google/redirect' , [HomeController::class , "googleRedirect"])->name('redirect');



Route::Post('usersignup' , [UserController::class , "store" ]  )->name('store');
Route::Post('userlogin' , [UserController::class ,"login"])->name('login');

