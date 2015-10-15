<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';
    public static $tableName = 'Категории товаров';
//    public static $fields = [
//        'key' => 'Ключ',
//        'name' => 'Имя',
//        'sort' => 'Сортировка',
//    ];
}
