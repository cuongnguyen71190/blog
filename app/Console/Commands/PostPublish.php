<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class PostPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:public';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish posts that have been scheduled';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::where('status', 0)->get();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $post['status'] = 1;

                $post->save();
            }
        }
    }
}
