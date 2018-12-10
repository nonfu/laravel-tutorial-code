<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'user_id' => mt_rand(1, 15),
        'commentable_id' => mt_rand(1, 30),
        'commentable_type' => $faker->randomElement([\App\Post::class, \App\Page::class])
    ];
});
