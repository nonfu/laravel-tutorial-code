<?php

use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'slug' => $faker->slug,
        'content' => $faker->text,
        'user_id' => mt_rand(1, 15)
    ];
});
