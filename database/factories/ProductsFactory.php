<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
	$name = $faker->sentence;
    $status = $faker->randomElement([\App\Product::PUBLISHED, \App\Product::PENDING,\App\Product::REJECTED]);   
    return [
        'marca_id' => \App\Marca::all()->random()->id,
        'indumentaria_id' => \App\Indumentaria::all()->random()->id,
        'genero_id' => \App\Genero::all()->random()->id,
        'name' => $name,
        'description' => $faker->paragraph,
    	'slug' => str_slug($name,'-'),
    	'picture' => \Faker\Provider\Image::image(storage_path(). '/app/public/products',600,350,'fashion',false),
    	'status' => $status,
    	'price' => $faker->numberBetween(5, 40),
    	
    ];
});
