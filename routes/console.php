<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
Artisan::command('password', function () {
    print(PHP_EOL);
    print(\Illuminate\Support\Facades\Hash::make('admin'));
    print(PHP_EOL);
});
Artisan::command('users', function () {
    $file = fopen(storage_path('app/data/file.csv'), 'r');
    $user = [];
    while ($data = fgetcsv($file)) {
        $users[] = [
            'first_name' => trim($data[1]),
            'last_name' => trim($data[2]),
            'national_code' => trim($data[4]),
            'personal_code' => trim($data[0]),
            'username' => trim($data[0]),
            'password' => \Illuminate\Support\Facades\Hash::make(trim($data[4])),
            'api_token' => \Illuminate\Support\Str::random(60),
            'level' => 2
        ];
    }
    \App\User::insert($users);
    print(PHP_EOL . count($users) . "added to database" . PHP_EOL);
});
Artisan::command('userUnits', function () {
    $file = fopen(storage_path('app/data/personal.csv'), 'r');
    $user = [];
    while ($data = fgetcsv($file)) {
        $data = fgetcsv($file);
        $unit = \App\Models\Employment\Unit::firstOrCreate(['name' => $data[1]]);
        $user = \App\User::where('personal_code', trim($data[2]))->get()->first();
        if (!is_null($user)) {
            $user->user_units_id = $unit->id;
            $user->save();
        }
    }
});
Artisan::command('addAdmin', function () {
    \App\User::create([
        'first_name' => 'مدیر',
        'last_name' => 'سیستم',
        'username' => 'admin',
        'password' => Hash::make('admin'),
        'api_token' => Str::random(60),
        'national_code' => '0000000000',
        'personal_code' => '0000000000',
        'level' => 1,
    ]);
});
