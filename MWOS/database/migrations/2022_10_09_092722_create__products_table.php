<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->unsignedBigInteger('prodCategory_ID');
            $table->foreign('prodCategory_ID')->references('id')->on('product_category')->onDelete('cascade');
            $table->string('size');
            $table->string('priceFull');
            $table->string('priceDp');
            $table->unsignedBigInteger('material_ID');
            $table->foreign('material_ID')->references('id')->on('materials')->onDelete('cascade');
            $table->string('description');
            $table->tinyInteger('rating')->nullable();
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
