<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);

        $taggables_data = [];
        for ($i = 0; $i < 30; $i++) {
            $taggables_data[] = [
                'tag_id' => mt_rand(1, 60),
                'taggable_id' => mt_rand(1, 30),
                'taggable_type' => array_random([\App\Post::class, \App\Page::class])
            ];
        }
        DB::table('taggables')->insert($taggables_data);
    }
}
