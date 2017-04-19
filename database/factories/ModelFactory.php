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
  $start_time = $faker->dateTimeBetween($startDate = 'now', $endDate = '3 days', $timezone = date_default_timezone_get());
  $start_time->setTime($start_time->format('H'), 30);;
  $end_time = clone $start_time;
  $end_time = $end_time->add(new DateInterval('PT90M'));
    return [
        'date' => $start_time->format('Y-m-d'),
        'start_time' => $start_time,
        'end_time' => $end_time,
        'party_size' => $faker->numberBetween($min = 1, $max = 10),
        'guest_id' => function () {
            return factory(App\Guest::class)->create();
        },
        'table_id' => function () {
            return App\Table::find(1);
        }
    ];
});
$factory->define(App\Hours::class, function(Faker\Generator $faker){
  return [
    'day' => rand(0,6),
    'open'=> $faker->time($format = '08:00:00', $max = 'now'),
    'close'=> $faker->time($format = '16:00:00', $max = 'now')
  ];
});
