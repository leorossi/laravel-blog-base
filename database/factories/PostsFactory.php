<?php

use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase(),
        'body' => $faker->realText(1000),
        'state' => $faker->randomElement(['draft', 'published'])
    ];
});
