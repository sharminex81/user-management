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

/**
 * Dashboard Route
 * Middleware has stored in kernel.php (/app/Http/Middleware)
 */
Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

//Signup route
Route::group(['prefix' => 'signup'], function () {
    Route::get('', 'AccessController@signup');
    Route::post('/process', 'AccessController@signupProcess');
});

Route::get('/profile', 'Profiles\ProfileController@home')->middleware('auth');

//Logout Route
Route::get('/logout', 'Auth\LoginController@logout');