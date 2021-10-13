<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class, 50)->create()->each(function ($comment) {
            if (rand(0, 1)) {
                $comment->track_id = rand(1, 3000);
                $comment->album_id = null;
            } else {
                $comment->album_id = rand(1, 200);
                $comment->track_id = null;
            }
            $comment->save();
        });
    }
}
