<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      if(!file_exists(app_path('Services'))) mkdir(app_path('Services'));

      $className      = $this->argument('model');
      if($this->checkIfServiceExists($className)) return false;

      $className      = $className.'Service';
      $classContainer = "<?php\n\nnamespace App\Services;\n\nclass $className {\n    \n}\n";
      $path           = app_path('Services/'.$className.'.php');
      file_put_contents($path, $classContainer);
      $this->line("  <bg=blue;fg=white> INFO </> Service [app/Services/$className] created successfully\n");
    }

    private function checkIfServiceExists($model)
    {
      $className = $model.'Service';
      $path      = app_path('Services/'.$className.'.php');
      if (file_exists($path)) {
        $this->line("  <error> ERROR </error> Service already exists\n");
        return true;
      }
      return false;
    }
}
