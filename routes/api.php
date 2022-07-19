<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Post('store' , [\App\Http\Controllers\UserController::class , "store" ]  );

Route::Post('password_reset' , [UserController::class , 'passwordReset']);
Route::get('reset' , [UserController::class , 'resetPassword'])->name('CReset')->middleware('signed');
Route::Post('reset' , [UserController::class , 'checkpasswordResetUri']);
Route::Post('userlogin' , [UserController::class ,"login"]);

