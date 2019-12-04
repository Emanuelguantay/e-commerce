<?php

use Faker\Generator as Faker;

$factory->define(App\Marca::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Adidas','Alpinestars','Borna','Fila','Jockey','Le Coq Sportif','Nike','Puma','Quiksilver','Volcom']),
        'description' => $faker->sentence
    ];
});
