<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
            \App\Models\Post::create([
                "title" => $faker->text(100),
                "content" => $faker->realText(300),
                "slug" => $faker->text(10),
                "creator" => rand(2,3),
                "status" => rand(0,1)
            ]);
        }
    }
}
