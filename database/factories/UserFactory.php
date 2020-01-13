<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Report;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Admin',
        'surname' => 'Godmodić',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'user_type' => 2,
        'password' => Hash::make('11111111'), // password
    ];
});
