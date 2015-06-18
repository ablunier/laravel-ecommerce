<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');

            $table->datetime('available_on');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('product_id');
            $table->string('locale')->index();

            $table->string('slug');
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

            $table->unique(['product_id','locale']);
        });

        Schema::table('products_translations', function (Blueprint $table) {
            $table->foreign('product_id')
                ->references('id')->on('products')
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
        Schema::dropIfExists('products_translations');
        Schema::dropIfExists('products');
    }
}
