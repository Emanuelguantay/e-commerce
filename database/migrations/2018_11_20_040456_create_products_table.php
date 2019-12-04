<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->unsignedInteger('indumentaria_id');
            $table->foreign('indumentaria_id')->references('id')->on('indumentarias');
            $table->unsignedInteger('genero_id');
            $table->foreign('genero_id')->references('id')->on('generos');

            $table->string('name')->unique()->notNullable();
            $table->text('description')->nullable();
            $table->string('slug');
            $table->string('picture')->nullable();
            $table->float('price', 8, 2);
//            $table->string('image')->nullable();
            $table->enum('status',[\App\Product::PUBLISHED, \App\Product::PENDING, \App\Product::REJECTED])->default(\App\Product::PENDING);
        //    $table->boolean('previous_approved')->default(false);
        //    $table->boolean('previous_rejected')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
