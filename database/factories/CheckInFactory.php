<?php
use App\User;
use Faker\Generator as Faker;

$factory->define(
    App\Models\TimeLog::class,
    function (Faker $faker) {
        return [
            'user_id' =>
                function () {
                return User::all()->random();
            },
            'time_in' => $faker->dateTime($max = 'now', $timezone = null),
            'time_out' => $faker->dateTime($max = 'now', $timezone = null),
            'day_of' => $faker->date($format = 'Y-m-d', $max = 'now')
        ];
    }
); 