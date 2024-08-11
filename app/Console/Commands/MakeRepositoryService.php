<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepositoryService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository-service {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $model         = $this->argument('model');
      $this->call('make:repository', ['model' => $model]);
      $this->call('make:service', ['model' => $model]);
    }
}
