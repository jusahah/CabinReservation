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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Targetgroup::class, function (Faker\Generator $faker) {
    return [
        'user_id' => rand(1, 5),
        'name' => $faker->name,
        'description' => $faker->sentence,
        'allowTwoReservationsInsideGroupBySameUser' => 0
    ];
});

$factory->define(App\Target::class, function (Faker\Generator $faker) {
    return [
        'targetgroup_id' => rand(1, 7),
        'name' => $faker->name,
        'description' => $faker->sentence,
        'maxReservationLength' => rand(1, 10),
        'minReservationLength' => 1,
        'emailWhenSomebodyReserves' => 1,
        'emailWhenSomebodyCancels' => 1,
        'emailWhenGeneralAnnouncement' => 1,
        'allowTwoReservationsBySameUser' => 0
    ];
});