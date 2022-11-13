<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('orders');
            $table->foreignId('rating')->constrained('orders');
            $table->foreignId('review')->constrained('orders');
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
        Schema::dropIfExists('Feedbacks');
    }
}
