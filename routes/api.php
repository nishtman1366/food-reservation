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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function () {
    Route::post('foods', 'FoodController@create');
    Route::post('foods/{id}', 'FoodController@update');
    Route::delete('foods/{id}', 'FoodController@delete');

    Route::post('days-foods', 'DaysFoodController@create');
    Route::put('days-foods', 'DaysFoodController@update');
    Route::delete('days-foods/{date}', 'DaysFoodController@delete');
    Route::post('reservations', 'OrderController@create');

    Route::post('users', 'UserController@create');
    Route::get('users/{id}', 'UserController@view');
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@delete');
});

