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


    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderController@index')->name('orders');
    });

    Route::prefix('reports')->group(function () {
        Route::get('/', 'ReportController@index')->name('reports.list');
        Route::match(['get', 'post'], '/{name}', 'ReportController@view')->name('reports.view');
    });

    Route::prefix('admin')->group(function () {
        Route::prefix('popups')->group(function () {
            Route::get('/', 'PopupController@index')->name('popups.list');
        });
    });

    Route::post('/logout', 'DashboardController@logout')->name('logout');
});
