<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Faker\Factory;
Use App\User;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Factory::create();
       for ($i=1; $i <=15; $i++){
           Post::create([
            'user_id'           => User::inRandomOrder()->first()->id ,
            'category_id'       => Category::inRandomOrder()->first()->id ,
            'title'             => $faker->sentence(4) ,
            'body'              => $faker->paragraph(),
            'image'             => sprintf("%02d",$i).'.jpg',
           ]);
       }
    }
}
