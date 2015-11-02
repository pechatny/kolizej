<?php

use App\Models\Page;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'admin',
            'email'    => 'admin@email.ru',
            'password' => Hash::make('123456'),
        ));
    }

}