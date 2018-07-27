<?php

use Faker\Generator as Faker;

$factory->define(App\Astreinte::class, function (Faker $faker) {
    return [
        "user_id" => 2,
        "type_astreinte_id" => 2,
        "status_astreinte_id" => 3,
        "start_at_date" => $faker->date(),
        "end_at_date" => $faker->date(),
        "start_at_time" => $faker->time(),
        "end_at_time" => $faker->time(),
    ];
});
