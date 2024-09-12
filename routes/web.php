<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\OrderController;
use App\Http\Controllers\SuperAdmin\ProductController;
use App\Http\Controllers\SuperAdmin\NotificationsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

//SuperAdmin
Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');
Route::get('/superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin_users');
Route::get('/superadmin/admin', [SuperAdminController::class, 'admin'])->name('superadmin_admin');
Route::get('/superadmin/profile', [SuperAdminController::class, 'profile'])->name('superadmin_profile');
Route::get('/superadmin/orders', [OrderController::class, 'orders'])->name('superadmin_orders');
Route::get('/superadmin/notification', [NotificationsController::class, 'notification'])->name('superadmin_notification');



Route::get('/superadmin/product', [ProductController::class, 'product'])->name('superadmin_product');
Route::post('/superadmin/product/create', [ProductController::class, 'create'])->name('superadmin_create');
Route::get('/superadmin/product/{id}', [ProductController::class, 'show'])->name('superadmin_product_show');
Route::post('/superadmin/product/update/image', [ProductController::class, 'imageUpdate'])->name('superadmin_product_image_update');
Route::post('/superadmin/product/update/form', [ProductController::class, 'formUpdate'])->name('superadmin_product_form_update');
Route::post('/superadmin/product/addres', [ProductController::class, 'newAddres'])->name('superadmin_product_new_addres');
Route::post('/superadmin/product/delete', [ProductController::class, 'Delete'])->name('superadmin_product_delete');
Route::post('/superadmin/product/admin/create', [ProductController::class, 'createAdmin'])->name('superadmin_product_create_admin');
Route::post('/superadmin/product/admin/delete', [ProductController::class, 'deleteAdmin'])->name('superadmin_product_create_delete');