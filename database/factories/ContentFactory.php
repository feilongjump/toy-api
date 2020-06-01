<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Content;
use Faker\Generator as Faker;

$factory->define(Content::class, function (Faker $faker) {

    $articleId = Article::whereUserId(1)->pluck('id')->random();

    return [
        'article_id' => $articleId,
        'markdown' => $faker->text
    ];
});
