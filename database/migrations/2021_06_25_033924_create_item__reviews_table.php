<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item__reviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('product_id');
            $table->string('name');
            $table->string('email');
            $table->string('product_review');
            $table->string('product_rating');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('product_id')->references('product_id')->on('items')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item__reviews');
    }
}
