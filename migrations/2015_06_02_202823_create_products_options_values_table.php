<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsOptionsValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_options_values', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_option_id');
        });

        Schema::create('products_options_values_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_option_value_id');
            $table->string('locale')->index();

            $table->string('value');

            $table->unique(['product_option_value_id','locale'], 'options_values_translations_id_locale_unique');
        });

        Schema::table('products_options_values', function (Blueprint $table) {
            $table->foreign('product_option_id')
                ->references('id')->on('products_options')
                ->onDelete('cascade');
        });

        Schema::table('products_options_values_translations', function (Blueprint $table) {
            $table->foreign('product_option_value_id', 'option_value_translation_id_foreign')
                ->references('id')->on('products_options_values')
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
        Schema::dropIfExists('products_options_values_translations');
        Schema::dropIfExists('products_options_values');
    }
}
