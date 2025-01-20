<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class HideOldPosts extends Command
{
    protected $signature = 'posts:hide-old';
    protected $description = 'Hide posts older than 15 days';

    public function handle()
    {
        $hiddenPosts = Post::where('created_at', '<', now()->subDays(5))->delete();
        $this->info("Successfully hidden {$hiddenPosts} old posts.");
    }
}
