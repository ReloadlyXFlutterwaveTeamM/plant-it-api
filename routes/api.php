<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\ReloadlyAPI;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get("logout", [AuthController::class,'logout']);
    Route::get("test", [DonateController::class,'test'], ['name' => 'test']);
    Route::post("donation", [DonateController::class,'donations']);
    Route::get("reloadly_airtime_access_token", [ReloadlyAPI::class,'airtime_access_token']);
    Route::get("reloadly_giftcard_access_token", [ReloadlyAPI::class,'giftcard_access_token']);
});



Route::post("signup", [AuthController::class,'signup']);
Route::post("signin", [AuthController::class,'signin']);
