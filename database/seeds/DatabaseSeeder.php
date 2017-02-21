<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Model::unguard();
        factory(App\User::class, 5)->create();
        factory(App\Post::class, 20)->create();
        factory(App\Tag::class, 12)->create();
        $i = 0;
        $pregeneratedCompoundIndices = [];
        while ($i < 30) {
            $post_id = mt_rand(1, 20);
            $tag_id = mt_rand(1, 12);
            if (!isset($pregeneratedCompoundIndices["{$post_id}_{$tag_id}"])) {
                $pregeneratedCompoundIndices["{$post_id}_{$tag_id}"] = "{$post_id}_{$tag_id}";
                DB::table('tags_map')->insert([
                    'post_id' => $post_id,
                    'tag_id' => $tag_id,
                ]);
            }
            ++$i;
        }
    }
}
