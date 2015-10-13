<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedInteger('category_id');
            $table->string('keywords');
            $table->string('description');
            $table->string('name');
            $table->string('images');
            $table->text('text');
            $table->unsignedSmallInteger('article');
            $table->unsignedSmallInteger('price');
            $table->unsignedSmallInteger('width');
            $table->unsignedSmallInteger('height');
            $table->unsignedSmallInteger('warranty');
            $table->unsignedSmallInteger('weight');
            $table->unsignedSmallInteger('depth');
            $table->unsignedSmallInteger('stock');
            $table->unsignedSmallInteger('params');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
