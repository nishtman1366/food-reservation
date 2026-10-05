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
Route::pattern('id', '[0-9]+');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function () {
    Route::post('foods', 'FoodController@create');
    Route::post('foods/{id}', 'FoodController@update');
    Route::post('foods/{id}/delete', 'FoodController@delete');

    Route::post('days-foods', 'DaysFoodController@create');
    Route::post('days-foods/update', 'DaysFoodController@update');
    Route::post('days-foods/{date}/delete', 'DaysFoodController@delete');
    Route::post('reservations', 'OrderController@create');

    Route::post('users', 'UserController@create');
    Route::post('users/change-password', 'UserController@changePassword');
    Route::get('users/{id}', 'UserController@view');
    Route::post('users/{id}', 'UserController@update');
    Route::post('users/{id}/delete', 'UserController@delete');

    Route::post('units', 'UnitController@create');
    Route::get('units/{id}', 'UnitController@view');
    Route::post('units/{id}', 'UnitController@update');
    Route::post('units/{id}/delete', 'UnitController@delete');

    Route::post('admin/popups', 'PopupController@create');
    Route::get('admin/popups/{id}', 'PopupController@view');
    Route::post('admin/popups/{id}', 'PopupController@update');
    Route::post('admin/popups/{id}/delete', 'PopupController@delete');

    Route::post('polls', 'PollController@create');
});
Route::post('users/personal-code', 'UserController@getPersonalCode');


