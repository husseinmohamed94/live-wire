<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'hussein mohmaed',
            'email' => 'hussein@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'hassan mohmaed',
            'email' => 'hassan@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        User::create([
            'name' => 'ahmed mohmaed',
            'email' => 'ahmed@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
