<?php

use Faker\Generator as Faker;

$factory->define(App\Product_talle::class, function (Faker $faker) {
    return [
    	'product_id' => \App\Product::all()->random()->id,
		'talle_id' => \App\Talle::all()->random()->id,
		'stock' => $faker->numberBetween(5, 30),
    ];
});

