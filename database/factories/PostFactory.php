<?php

use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->text,
        'user_id' => mt_rand(1, 15),
        'views' => $faker->randomDigit
    ];
});

$factory->define(\App\Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word
    ];
});