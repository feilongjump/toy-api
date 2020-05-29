<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    
    $userId = User::where('id', '<', 5)->pluck('id')->random();

    return [
        'user_id' => $userId,
        'title' => $faker->sentence
    ];
});
