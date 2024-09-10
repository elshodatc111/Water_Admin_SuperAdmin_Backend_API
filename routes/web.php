<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//SuperAdmin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');


//Admin
Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');
