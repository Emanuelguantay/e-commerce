<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Storage::deleteDirectory('products');
        Storage::deleteDirectory('users');

        Storage::makeDirectory('products');
        Storage::makeDirectory('users');

        factory(\App\Role::class, 1)->create(['name'=>'admin']);
        factory(\App\Role::class, 1)->create(['name'=>'vendedor']);
        factory(\App\Role::class, 1)->create(['name'=>'cliente']);

        factory(\App\User::class, 1)->create([
        	'name'=>'admin',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('secret'),
        	'role_id' => \App\Role::ADMIN
        ]);

        factory(\App\User::class, 1)->create([
        	'name'=>'vendedor',
        	'email' => 'vendedor@gmail.com',
        	'password' => bcrypt('secret'),
        	'role_id' => \App\Role::VENDEDOR
        ]);

        factory(\App\User::class, 1)->create([
        	'name'=>'cliente',
        	'email' => 'cliente@gmail.com',
        	'password' => bcrypt('secret'),
        	'role_id' => \App\Role::CLIENTE
        ]);

        factory(\App\Talle::class,1)->create(['name' =>'XS']);
        factory(\App\Talle::class,1)->create(['name' =>'S']);
        factory(\App\Talle::class,1)->create(['name' =>'M']);
        factory(\App\Talle::class,1)->create(['name' =>'L']);
        factory(\App\Talle::class,1)->create(['name' =>'XL']);
        factory(\App\Talle::class,1)->create(['name' =>'XXL']);

        factory(\App\Genero::class,1)->create(['name' =>'Mujer']);
        factory(\App\Genero::class,1)->create(['name' =>'Hombre']);

        factory(\App\Marca::class,6)->create();
        factory(\App\Indumentaria::class,4)->create();

        factory(\App\Product::class, 20)->create();
        //factory(\App\Product_talle::class,10)->create();

    }
}
