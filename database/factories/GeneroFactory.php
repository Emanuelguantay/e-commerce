<?php

use Faker\Generator as Faker;

$factory->define(App\Genero::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
