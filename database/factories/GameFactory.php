<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'released' => $faker->date(),
        'director' => $faker->name,
        'critic_score' => $faker->randomDigit,
        'user_score' => $faker->randomDigit
    ];
});
