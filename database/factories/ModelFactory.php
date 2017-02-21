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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'tag' => implode(' ', $faker->unique()->words(mt_rand(1, 3))),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(mt_rand(3, 10)),
        'content' => implode('<br /><br />', $faker->paragraphs(mt_rand(6, 20))),
        'published_at' => $faker->dateTimeBetween('-1 month', '+3 days'),
        'user_id' => mt_rand(1, 5),
    ];
});
