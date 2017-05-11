<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\News::class, function (Faker\Generator $faker) {
    return [
        'title'   => $faker->sentence,
        'content' => $faker->realText(3000, 4),
        //'user_id' => factory(App\Models\User::class)->create()->id,
        'user_id'    => App\Models\User::all()->random()->id,
        'created_at' => $faker->dateTime(\Carbon\Carbon::now(), date_default_timezone_get()),
        'updated_at' => null,
    ];
});
