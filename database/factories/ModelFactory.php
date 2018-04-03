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
        'phone_number' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'handle' => $faker->userName,
        'avatar_url' => $faker->imageUrl(100, 100, 'cats'),
        'total_points' => $faker->numberBetween(10, 1000),
        'last_activity' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'is_admin' => $faker->boolean($chanceOfGettingTrue = 50),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\DebateCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence($nbWords = 1),
        'image_url' => $faker->imageUrl(100, 100, 'cats'),
        'icon_url' => $faker->imageUrl(50, 50, 'cats'),
    ];
});


$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'category_id' => $faker->numberBetween($min = 1, $max = 11), //Specific categories defined in CategoryTableSeeder
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->sentence($nbWords = 6),
        'text' => $faker->sentence($nbWords = 12, $variableNbWords = true),
        'medium' => $faker->randomElement($array = array ('video','post','tweet')),
        'source' => $faker->randomElement($array = array ('espn','post','tweet')),
        'publish_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'expire_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Debate::class, function (Faker\Generator $faker) {
    return [
        'question_id' => function () {
            return factory('App\Question')->create()->id;
        },
        'status' => $faker->randomElement($array = array ('active','needs_opponent','completed')),
        'starts_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'ends_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Debate::class, function (Faker\Generator $faker) {
    return [
        'question_id' => function () {
            return factory('App\Question')->create()->id;
        },
        'status' => $faker->randomElement($array = array ('active','needs_opponent','completed')),
        'starts_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        'ends_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});

$factory->state(App\Debate::class, 'active', function ($faker) {
    return [
        'status' => 'active'
    ];
});

$factory->state(App\Debate::class, 'needs_opponent', function ($faker) {
    return [
        'status' => 'needs_opponent'
    ];
});


$factory->define(App\DebateArgument::class, function (Faker\Generator $faker) {
    return [
        //'debate_id' => function () {
        //    return factory('App\Debate')->create()->id;
        //},
        //'user_id' => function () {
        //    return factory('App\User')->create()->id;
        //},
        'argument' => $faker->sentence($nbWords = 20, $variableNbWords = true)
    ];
});
