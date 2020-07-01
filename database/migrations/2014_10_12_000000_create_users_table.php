<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->string('national_code');
            $table->string('personal_code')->unique();
            $table->string('level');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('users')->insert([
            [
                'first_name' => 'مدیر',
                'last_name' => 'سیستم',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'api_token' => Str::random(60),
                'national_code' => '0000000000',
                'personal_code' => '0000000000',
                'level' => 1,
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
