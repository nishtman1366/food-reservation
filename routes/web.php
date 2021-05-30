<?php

use App\User;
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
        Route::match(['GET', 'POST'], '/', 'UserController@index')->name('users.list');
        Route::prefix('units')->group(function () {
            Route::get('/', 'UnitController@index')->name('users.units.list');
        });
    });

    Route::prefix('foods-reservations')->group(function () {
        Route::get('/', 'FoodController@index')->name('foods.reservation');
        Route::get('/foods', 'FoodController@index')->name('foods.list');
        Route::get('/days-foods', 'DaysFoodController@index')->name('days.foods');
    });


    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderController@index')->name('orders');
    });

    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', 'ConferenceController@index')->name('list');
        Route::get('/new', 'ConferenceController@create')->name('create');
        Route::post('/', 'ConferenceController@store')->name('store');
        Route::get('/{id}', 'ConferenceController@view')->name('view');
        Route::put('/{id}', 'ConferenceController@update')->name('update');
        Route::get('/{id}/delete', 'ConferenceController@destroy')->name('delete');
    });


    Route::prefix('surveys')->name('surveys.')->namespace('Survey')->group(function () {
        Route::post('', 'QuestionController@submit')->name('submit');
        Route::prefix('questions')->name('questions.')->group(function () {
            Route::get('/', 'QuestionController@index')->name('list');
            Route::get('/new', 'QuestionController@create')->name('create');
            Route::post('/', 'QuestionController@store')->name('store');
            Route::get('/{id}', 'QuestionController@view')->name('view');
            Route::put('/{id}', 'QuestionController@update')->name('update');
            Route::get('/{id}/delete', 'QuestionController@destroy')->name('delete');
            Route::get('/{id}/stats', 'QuestionController@stats')->name('stats');
        });
    });

    Route::prefix('reports')->group(function () {
        Route::get('/', 'ReportController@index')->name('reports.list');
        Route::match(['get', 'post'], '/{name}', 'ReportController@view')->name('reports.view');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('', 'SettingController@index')->name('main');
        Route::post('', 'SettingController@update')->name('update');
    });

    Route::prefix('admin')->group(function () {
        Route::prefix('popups')->group(function () {
            Route::get('/', 'PopupController@index')->name('popups.list');
        });
    });

    Route::post('/logout', 'DashboardController@logout')->name('logout');
});

Route::get('csv', function () {
    $file = fopen(storage_path('app/data') . '/personal.csv', 'r');
    if (!$file) die('error');
    while (!feof($file)) {
        $data = fgetcsv($file);
        $unit = \App\Models\Employment\Unit::firstOrCreate(['name' => $data[1]]);
        $user = User::where('personal_code', trim($data[2]))->get()->first();
        if (!is_null($user)) {
            $user->user_units_id = $unit->id;
            $user->save();
        }
    }
});
