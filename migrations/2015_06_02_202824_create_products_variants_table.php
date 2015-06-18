<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_variants', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('master');
            $table->string('sku');
            $table->integer('price');
            $table->integer('on_hand');
            $table->boolean('available_on_demand');
            $table->decimal('weight')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('depth')->nullable();

            $table->unsignedInteger('product_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products_variants_options_values', function (Blueprint $table) {
            $table->unsignedInteger('product_variant_id');
            $table->unsignedInteger('product_option_value_id');
        });

        Schema::table('products_variants', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
        });

        Schema::table('products_variants_options_values', function (Blueprint $table) {
            $table->foreign('product_variant_id')
                ->references('id')->on('products_variants')
                ->onDelete('cascade');

            $table->foreign('product_option_value_id')
                ->references('id')->on('products_options_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_variants_options_values');
        Schema::dropIfExists('products_variants');
    }
}
