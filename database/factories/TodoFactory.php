<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {

    $userId = User::where('id', '<', 5)->pluck('id')->random();

    return [
        'user_id' => $userId,
        'matter' => $faker->sentence
    ];
});
