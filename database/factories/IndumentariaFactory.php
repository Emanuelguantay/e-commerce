<?php

use Faker\Generator as Faker;

$factory->define(App\Indumentaria::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Camisas','Remeras','Buzos','Camperas','Chalecos','Chombas','Jeans','Pantalones']),
        'description' => $faker->sentence
    ];
});
