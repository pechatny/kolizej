<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'key' => '',
            'name' => 'Главная',
            'sort' => '1',
        ]);
        Menu::create([
            'key' => 'catalog',
            'name' => 'Каталог',
            'sort' => '2',
        ]);
        Menu::create([
            'key' => 'delivery',
            'name' => 'Доставка и оплата',
            'sort' => '3',
        ]);
        Menu::create([
            'key' => 'orderFurniture',
            'name' => 'Мебель на заказ',
            'sort' => '4',
        ]);
        Menu::create([
            'key' => 'wholesalers',
            'name' => 'Оптовикам',
            'sort' => '5',
        ]);
        Menu::create([
            'key' => 'contacts',
            'name' => 'Контакты',
            'sort' => '6',
        ]);
    }
}
