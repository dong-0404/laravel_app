<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;


Route::get('/admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/users/login/store', [LoginController::class, 'store']);
Route::middleware('auth')->group(function() {
    Route::get('admin', [MainController::class, 'index'])->name('admin');
    Route::get('admin/main', [MainController::class, 'index']);

});
//Route::get('/users', [LoginController::class, 'login']);

Route::get('/admin/users/create', [UserController::class, 'create']);
Route::post('/admin/users/create', [UserController::class, 'store']);
// Update user
// Nhớ là phải truyền thêm id để biết được đối tượng muốn sửa nhé
Route::get('/admin/users/update/{id}', [UserController::class, 'edit']);
Route::post('/admin/users/update/{id}', [UserController::class, 'update']);
