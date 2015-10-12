<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $table = 'pages';
    public static $tableName = 'Страницы';
    public static $fields = [
        'description' => 'Описание',
        'keywords' => 'Ключевые слова',
        'title' => 'Заголовок',
        'page_title' => 'Заголовок страницы',
        'text' => 'Текст',
        'elements' => 'Элементы',
    ];
}
