<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/login', [ApiUserController::class, 'login']); // Telefon raqamni so'rash uchun
Route::post('user/login/code', [ApiUserController::class, 'code']);  //  Tasdiqlash kodini tekshiradi va profelga kiradi birinchi marta ro'yhatdan o'tqan bo'lsa Ismini so'raydi
Route::post('user/login/name', [ApiUserController::class, 'nameCreate']);   // Yangi buyurtmachi uchun ismini so'raladi



Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('user/home', [ApiUserController::class, 'home']); // Bosh sahifa
    Route::get('user/home/{id}', [ApiUserController::class, 'homeShow']);   // Mahsulot haqida malumot olish uchun
    Route::post('user/buyurtma', [ApiUserController::class, 'buyurtma']);   // Buyurtma qabul qilish uchun
});