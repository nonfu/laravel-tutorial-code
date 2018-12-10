<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\App\Post::class, 30)->create();
        factory(\App\Tag::class, 60)->create();
        $post_tags_data = [];
        for ($i = 0; $i < 30; $i++) {
            $post_tags_data[] = [
                'tag_id' => mt_rand(1, 60),
                'post_id' => mt_rand(1, 30),
            ];
        }
        DB::table('post_tags')->insert($post_tags_data);
    }
}
