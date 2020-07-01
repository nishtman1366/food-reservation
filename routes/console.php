<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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
