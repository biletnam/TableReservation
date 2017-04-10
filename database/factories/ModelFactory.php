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
$factory->define(App\Table::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->colorName,
        'seats' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
$factory->define(App\Guest::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->tollFreePhoneNumber,
        'email' => $faker->safeEmail,
    ];
});
$factory->define(App\Reservation::class, function (Faker\Generator $faker) {
    return [
        'reservation_time' => $faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now', $timezone = date_default_timezone_get()),
        'party_size' => $faker->numberBetween($min = 1, $max = 10),
        'guest_id' => function () {
            return factory(App\Guest::class)->create();
        },
        'table_id' => function () {
            return App\Table::find(1);
        }
    ];
});