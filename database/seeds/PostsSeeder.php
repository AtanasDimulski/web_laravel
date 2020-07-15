<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //



        // Post data into database
        $post = new Post;
        $post->title = 'Seed Post';
        $post->author = 'The seed of seeds';
        $post->body = 'This is where the first seeder was tested for the seeding process to seedly happen';




        $post2 = new Post;
        $post2->title = 'Seed Post2';
        $post2->author = 'The seed of seeds 2';
        $post2->body = 'This is where the second seeder was tested for the seeding process to seedly happen';

        $post2->save();
        $post->save();
    }
}
