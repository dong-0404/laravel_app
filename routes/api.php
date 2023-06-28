<?php

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
//Route::get('/admin/users/login', [LoginController::class, 'index'])->name('login'); 
Route::get('/users', [LoginController::class, 'login']);
//Route::middleware('auth')->group(function() {
//    Route::get('admin', [MainController::class, 'index'])->name('admin');
//    Route::get('admin/main', [MainController::class, 'index']);
//
//});

