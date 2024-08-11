<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeResource extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:resources {model}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new model and repository service';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $model         = $this->argument('model');
    $this->call('make:model', ['name' => $model, '-a' => true]);
    $this->call('make:repository-service', ['model' => $model]);
  }
}
