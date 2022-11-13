<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Custom', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productCategory_id')->constrained('product_categorys');
            $table->string('image');
            $table->string('state');
            $table->string('fix');
            $table->integer('price');
            $table->foreignId('material_id')->constrained('materials');
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
        Schema::dropIfExists('Custom');
    }
}
