<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\registerProductController;
use App\Http\Controllers\productOrders;
use App\Http\Controllers\registerBusiness;
use App\Http\Controllers\replaceCert;
use App\Http\Controllers\registerTrademark;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\search;
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


Route::group(['prefix' => 'admin', 'middleware' => 'auth:api'], function(){
});
Route::middleware('auth:sanctum')->resource('/register-product', registerProductController::class);
Route::middleware('auth:sanctum')->get('/register-product/search/{val}', [registerProductController::class,'search']);
Route::resource('/replace-cert', replaceCert::class);
Route::resource('/register-business', registerBusiness::class);
Route::resource('/register-trademark', registerTrademark::class);
Route::resource('/chat', ChatController::class);
Route::post('/register', [Authcontroller::class,'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json(['user'=>$request->user()]);
});
Route::post('/login', [Authcontroller::class,'login']);
Route::middleware('auth:sanctum')->get('/logout', [Authcontroller::class,'logout']);
Route::middleware('auth:sanctum')->get('/update-user', [Authcontroller::class,'updateUser']);
Route::middleware('auth:sanctum')->get('/product-order/{value}', [ordersController::class,'productOrder']);
Route::middleware('auth:sanctum')->get('/trademark-order/{value}', [ordersController::class,'trademarkOrder']);
Route::middleware('auth:sanctum')->get('/business-order/{value}', [ordersController::class,'businessNameOrder']);
Route::middleware('auth:sanctum')->resource('/orders', ordersController::class);
Route::middleware('auth:sanctum')->get('/orders/search/{val}',[ ordersController::class,'search']);
