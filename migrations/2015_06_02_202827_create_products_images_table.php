<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_images', function (Blueprint $table) {
            $table->increments('id');

            $table->string('path');

            $table->unsignedInteger('product_variant_id');
        });

        Schema::table('products_images', function (Blueprint $table) {
            $table->foreign('product_variant_id')
                ->references('id')->on('products_variants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_images');
    }
}
