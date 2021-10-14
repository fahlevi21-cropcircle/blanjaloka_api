<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('name', 50)->unique();
            $table->string('description', 500);
            $table->string('category');
            $table->integer('price');
            $table->integer('stock');
            $table->string('measure', 15);
            $table->unsignedBigInteger('store_id');
            $table->string('picture', 500)->nullable()->default();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('CASCADE')->onUpdate('CASCADE');
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
