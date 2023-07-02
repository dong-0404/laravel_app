<?php
use Illuminate\Support\Facades\Route;

Route::get('test-abc', 'App\Http\Controllers\UserController@testAbc');
Route::get('findUser/{id}','App\Http\Controllers\UserController@findUser' );
