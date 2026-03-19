<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Reply;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        $tags = Post::factory(10)->create();
        $posts = Tag::factory(10)->recycle($users)->recycle($tags)->create();
        $comments = Comment::factory(10)->recycle($users)->recycle($posts)->create();
        Reply::factory(10)->recycle($users)->recycle($comments)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
