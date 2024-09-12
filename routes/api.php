<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login', [ApiUserController::class, 'login']);
Route::post('user/login/code', [ApiUserController::class, 'code']);
Route::post('user/login/name', [ApiUserController::class, 'nameCreate']);



Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('user/home', [ApiUserController::class, 'home']);
    Route::get('user/home/{id}', [ApiUserController::class, 'homeShow']);
    Route::post('user/buyurtma', [ApiUserController::class, 'buyurtma']);
});