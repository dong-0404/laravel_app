<?php
use Illuminate\Support\Facades\Route;

Route::get('User', 'App\Http\Controllers\UserController@index');
Route::get('findUser/{id}','App\Http\Controllers\UserController@findUser' );
Route::get('showUser', 'App\Http\Controllers\UserController@show');
Route::post('updateUser/{id}','App\Http\Controllers\UserController@update' );
Route::get('updateUser/{id}', 'App\Http\Controllers\UserController@edit');
//Route::post('updateUser/{id}','App\Http\Controllers\UserController@update');
Route::delete('deleteUser/{id}','App\Http\Controllers\UserController@destroy');
Route::get('filterUser', 'App\Http\Controllers\UserController@filter' );


Route::get('Customer','App\Http\Controllers\CustomerController@index');
Route::get('Customer/show','App\Http\Controllers\CustomerController@findCustomer');
Route::post('createCustomer', 'App\Http\Controllers\CustomerController@createCustomer');
Route::post('updateCustomer/{id}', 'App\Http\Controllers\CustomerController@updateCustomer');
Route::delete('deleteCustomer/{id}','App\Http\Controllers\CustomerController@deleted');

Route::get('/products','App\Http\Controllers\ProductController@index' );
Route::get('/product/{id}','App\Http\Controllers\ProductController@show');
Route::post('/addProducts', 'App\Http\Controllers\ProductController@store');
Route::post('/product/{id}', 'App\Http\Controllers\ProductController@update');
Route::delete('/product/{id}', 'App\Http\Controllers\ProductController@destroy');

Route::get('/categories','App\Http\Controllers\CategoryController@index' );

Route::get('/OrderItem/{id}','App\Http\Controllers\OrderItemController@index' );
Route::delete('/DeleteOrderItem/{id}','App\Http\Controllers\OrderItemController@destroy' );
Route::post('/AddItem','App\Http\Controllers\OrderItemController@store' );


Route::post('CreateOrder', 'App\Http\Controllers\OrderItemController@store');



Route::get('/Order','App\Http\Controllers\OrderController@index' );
Route::post('/Order/Create','App\Http\Controllers\OrderController@store' );
Route::post('Order/Update/{id}','App\Http\Controllers\OrderController@update');
Route::delete('Order/Delete/{id}','App\Http\Controllers\OrderController@destroy');
Route::get('getOrder','App\Http\Controllers\OrderController@search' );


Route::group([
    'middleware' => 'api','auth:api',
    'prefix' => 'auth'
], function($route) {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
    Route::get('user-profile', [App\Http\Controllers\AuthController::class, 'userProfile'])->name('user-profile');
    Route::post('updateUserProfile/{id}',[App\Http\Controllers\UserController::class, 'updateUserProfile']);
//    Route::post('/update-password', 'App\Http\Controllers\AuthController@updatePassword');
    Route::post('/changePassword', 'App\Http\Controllers\UserController@changePassword');



    // Route::get('/User', 'App\Http\Controllers\UserController@index')->middleware('check_role');
    // Route::post('/Order/Create','App\Http\Controllers\OrderController@store' )->middleware('check_role');
});

Route::get('Test', 'App\Http\Controllers\TestController@Test');
