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
            $table->string('keywords')->null();
            $table->string('description')->null();
            $table->string('name')->null();
            $table->text('images')->null();
            $table->text('text')->null();
            $table->unsignedSmallInteger('article')->null();
            $table->unsignedSmallInteger('price')->null();
            $table->unsignedSmallInteger('width')->null();
            $table->unsignedSmallInteger('height')->null();
            $table->unsignedSmallInteger('warranty')->null();
            $table->unsignedSmallInteger('weight')->null();
            $table->unsignedSmallInteger('depth')->null();
            $table->unsignedInteger('views')->null();
            $table->boolean('stock')->null();
            $table->unsignedSmallInteger('params')->null();
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
