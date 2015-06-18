<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsPropertiesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_properties_values', function (Blueprint $table) {
            $table->increments('id');

            $table->string('value');

            $table->unsignedInteger('product_id');
            $table->unsignedInteger('property_id');
        });

        Schema::table('products_properties_values', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');

            $table->foreign('property_id')
                ->references('id')->on('products_properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_properties_values');
    }
}
