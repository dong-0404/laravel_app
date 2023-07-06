<?php
use Illuminate\Support\Facades\Route;

Route::get('User', 'App\Http\Controllers\UserController@index');
Route::get('findUser/{id}','App\Http\Controllers\UserController@findUser' );
Route::get('showUser', 'App\Http\Controllers\UserController@show');
Route::post('createUser','App\Http\Controllers\UserController@store' );
Route::get('updateUser/{id}', 'App\Http\Controllers\UserController@edit');
//Route::post('updateUser/{id}','App\Http\Controllers\UserController@update');
Route::delete('deleteUser/{id}','App\Http\Controllers\UserController@destroy');
Route::get('filterUser', 'App\Http\Controllers\UserController@filter' );


Route::get('Customer','App\Http\Controllers\CustomerController@index');
Route::get('Customer/show','App\Http\Controllers\CustomerController@findCustomer');
Route::post('Customers', 'App\Http\Controllers\CustomerController@store');
Route::get('editCustomer/{id}', 'App\Http\Controllers\UserController@edit');
Route::delete('deleteCustomer/{id}','App\Http\Controllers\CusomerphpController@deleted');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function($route) {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
});
