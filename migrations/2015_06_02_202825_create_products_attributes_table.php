<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_attributes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
        });

        Schema::create('products_attributes_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_attribute_id');
            $table->string('locale')->index();

            $table->string('presentation');

            $table->unique(['product_attribute_id','locale']);
        });

        Schema::table('products_attributes_translations', function (Blueprint $table) {
            $table->foreign('product_attribute_id')
                ->references('id')->on('products_attributes')
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
        Schema::dropIfExists('products_attributes_translations');
        Schema::dropIfExists('products_attributes');
    }
}
