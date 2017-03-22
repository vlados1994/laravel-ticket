<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductsPhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_products_phone', function (Blueprint $table) {
            $table->increments('phone_id');
            $table->string('os');
            $table->string('sim_quantity');
            $table->string('screen_type');
            $table->string('resolution');
            $table->string('camera');
            $table->boolean('lte');
            $table->string('interfaces');
            $table->string('cpu');
            $table->integer('rom');
            $table->integer('ram');
            $table->integer('battery');
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('catalog_products')
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
        Schema::dropIfExists('catalog_products_phone');
    }
}
