<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Default route (Login route)
Route::get('/', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@loginProcess');

//Signup route
Route::group(['prefix' => 'signup'], function () {
    Route::get('', 'AccessController@signup');
    Route::post('/process', 'AccessController@signupProcess');
});