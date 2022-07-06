<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => 'Steve',
            "email" => 'first@yandex.ru',
            "password" => bcrypt('123456'),
        ]);
        User::create([
            "name" => 'Alice',
            "email" => 'second@yandex.ru',
            "password" => bcrypt('123456'),
        ]);
    }
}
