<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->comment('Ключ');
            $table->string('description')->comment('Описание');
            $table->string('keywords')->comment('Ключевые слова');
            $table->string('title')->comment('Заголовок');
            $table->string('page_title')->comment('Заголовок на странице');
            $table->text('text')->comment('Текст');
            $table->text('elements')->comment('Элементы');
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
        Schema::drop('pages');
    }
}
