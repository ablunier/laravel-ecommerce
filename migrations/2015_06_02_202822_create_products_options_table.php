<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_options', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->unsignedInteger('product_id');

            $table->timestamps();
        });

        Schema::create('products_options_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_option_id');
            $table->string('locale')->index();

            $table->string('presentation');

            $table->unique(['product_option_id','locale']);
        });

        Schema::table('products_options', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
        });

        Schema::table('products_options_translations', function (Blueprint $table) {
            $table->foreign('product_option_id')
                ->references('id')->on('products_options')
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
        Schema::dropIfExists('products_options_translations');
        Schema::dropIfExists('products_options');
    }
}
