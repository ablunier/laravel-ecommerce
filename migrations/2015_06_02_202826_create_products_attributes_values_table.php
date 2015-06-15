<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsAttributesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_attributes_values', function (Blueprint $table) {
            $table->increments('id');

            $table->string('value');

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('product_attribute_id');
        });

        Schema::table('products_attributes_values', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');

            $table->foreign('product_attribute_id')
                ->references('id')->on('products_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_attributes_values');
    }
}
