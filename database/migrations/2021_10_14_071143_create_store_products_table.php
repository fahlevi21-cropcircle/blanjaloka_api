<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('token_id')->unique();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->foreign('token_id')->references('id')->on('tokens')->onDelete('CASCADE')->onUpdate('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_products');
    }
}
