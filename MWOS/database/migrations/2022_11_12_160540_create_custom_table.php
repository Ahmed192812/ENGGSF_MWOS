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
        Schema::create('Customs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('productCategory_id')->constrained('product_categorys');
            $table->string('image');
            $table->string('description');
            $table->integer('price')->nullable();
            $table->foreignId('material_id')->constrained('materials')->nullable(); // options provided by the store
            $table->string('desiredMaterial')->nullable(); // optional material. provided by the user
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
        Schema::dropIfExists('Customs');
        Schema::table('Customs',function(Blueprint $table){
            $table->softDeletes();
        });
    }
}
