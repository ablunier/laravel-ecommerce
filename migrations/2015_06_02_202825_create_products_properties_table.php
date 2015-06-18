<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_properties', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
        });

        Schema::create('products_properties_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('property_id');
            $table->string('locale')->index();

            $table->string('presentation');

            $table->unique(['property_id','locale']);
        });

        Schema::table('products_properties_translations', function (Blueprint $table) {
            $table->foreign('property_id')
                ->references('id')->on('products_properties')
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
        Schema::dropIfExists('products_properties_translations');
        Schema::dropIfExists('products_properties');
    }
}
