<?php

use Faker\Generator as Faker;

$factory->define(App\Talle::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence
    ];


});
