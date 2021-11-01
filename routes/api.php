<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\registerProductController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\replyController;
use App\Http\Controllers\productOrders;
use App\Http\Controllers\registerBusiness;
use App\Http\Controllers\replaceCert;
use App\Http\Controllers\registerTrademark;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\userController;
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
Route::middleware('auth:sanctum')->resource('/register-business', registerBusiness::class);
Route::middleware('auth:sanctum')->get('/register-business/search/{val}', [registerBusiness::class,'search']);
Route::resource('/register-trademark', registerTrademark::class);
Route::resource('/chat', ChatController::class);
Route::post('/register', [Authcontroller::class,'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json(['user'=>$request->user()]);
});
Route::post('/login', [Authcontroller::class,'login']);
Route::middleware('auth:sanctum')->get('/logout', [Authcontroller::class,'logout']);
Route::middleware('auth:sanctum')->post('/update-user', [Authcontroller::class,'updateUser']);
Route::middleware('auth:sanctum')->post('/product-order', [ordersController::class,'productOrder']);
Route::middleware('auth:sanctum')->post('/trademark-order/{value}', [ordersController::class,'trademarkOrder']);
Route::middleware('auth:sanctum')->post('/business-order', [ordersController::class,'businessNameOrder']);
Route::middleware('auth:sanctum')->resource('/orders', ordersController::class);
Route::middleware('auth:sanctum')->get('/orders/search/{val}',[ ordersController::class,'search']);
Route::middleware('auth:sanctum')->resource('/message', MessageController::class);
Route::middleware('auth:sanctum')->get('/message/search/{val}',[ messageController::class,'search']);
Route::middleware('auth:sanctum')->resource('/reply', replyController::class);
Route::middleware('auth:sanctum')->resource('/users', userController::class);
Route::middleware('auth:sanctum')->get('/users/search/{val}',[ userController::class,'search']);