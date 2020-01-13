<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Report;

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

$factory->define(Report::class, function (Faker $faker) {

   $user_ids = \DB::table('users')->select('id')->get();
   $user_id = $faker->randomElement($user_ids)->id;

    $category_ids = \DB::table('categories')->select('id')->get();
    $category_id = $faker->randomElement($category_ids)->id;


    return [
        'description' => $faker->text(1000),
        'address' => $faker->streetAddress,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'image_user' => $faker->image('public/storage/images',400,300, 'cats', false),
        'reported_at' => $faker->dateTime,
        'user_id' => $user_id,
        'category_id' => $category_id
    ];
});
