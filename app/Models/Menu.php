<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $table = 'menu';
    public static $tableName = 'Меню';
    public static $fields = [
        'key' => 'Ключ',
        'name' => 'Имя',
        'sort' => 'Сортировка',
    ];

    public function getMenuHtml($current){
        $menuItems = $this->all();
        $menuHtml = view('menu', ['menuItems' => $menuItems, 'current' => $current])->render();

        return $menuHtml;
    }
}
