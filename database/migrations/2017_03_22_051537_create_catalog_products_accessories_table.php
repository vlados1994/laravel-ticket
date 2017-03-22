<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductsAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_products_accessories', function (Blueprint $table) {
            $table->increments('accessory_id');
            $table->string('material')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('catalog_products_accessories');
    }
}
