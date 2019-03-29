<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;

class GeneratePostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:generate {amount} {--role=editor}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an amount posts.';

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
     * @return mixed
     */
    public function handle()
    {
        $amount = intVal($this->argument('amount'));
        factory(Post::class, $amount)->create();
        $this->info('Created ' . $amount . ' posts.');
    }
}
