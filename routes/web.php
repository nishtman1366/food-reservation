<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');
Route::get('/login', 'DashboardController@login')->name('login');
Route::post('/login', 'DashboardController@signIn')->name('sign.in');
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('users.list');
    });

    Route::prefix('foods-reservations')->group(function () {
        Route::get('/', 'FoodController@index')->name('foods.reservation');
        Route::get('/foods', 'FoodController@index')->name('foods.list');
        Route::get('/days-foods', 'DaysFoodController@index')->name('days.foods');
    });


//    Route::get('/reservations', '')->name('reservations');


    Route::post('/logout', 'DashboardController@logout')->name('logout');
});
