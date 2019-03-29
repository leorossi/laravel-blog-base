<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class GenerateUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:generate {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate users.';

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
        factory(User::class, $amount)->create();
        $this->info('Created ' . $amount . ' users.');
    }
}
