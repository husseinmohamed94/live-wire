<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(PostTableSeeder::class);
    }
}
