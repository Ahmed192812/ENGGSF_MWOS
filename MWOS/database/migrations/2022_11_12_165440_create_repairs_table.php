<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Repairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('productCategory_id')->constrained('product_categorys');
            $table->string('image');
            $table->string('furnitureState'); // description of the damage of the furniture
            $table->integer('estimatedPrice')->nullable();
            $table->integer('actualPrice')->nullable();         
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Repairs');
        Schema::table('Repairs',function(Blueprint $table){
            $table->softDeletes();
        });
    }
}
