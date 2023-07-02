<?php
use Illuminate\Support\Facades\Route;

Route::get('test-abc', 'App\Http\Controllers\UserController@index');
Route::get('findUser/{id}','App\Http\Controllers\UserController@findUser' );
Route::get('showUser/{id}', 'App\Http\Controllers\UserController@show');
Route::get('createUser','App\Http\Controllers\UserController@store' );
Route::get('updateUser/{id}', 'App\Http\Controllers\UserController@edit');
Route::post('updateUser/{id}','App\Http\Controllers\UserController@update');
Route::delete('deleteUser/{id}','App\Http\Controllers\UserController@destroy');
