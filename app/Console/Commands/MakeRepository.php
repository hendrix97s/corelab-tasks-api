<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * Execute the console command.
     */
    public function handle()
    {

      // check if repository already exists
      if(!file_exists(app_path('Repositories'))) mkdir(app_path('Repositories'));

      $model          = $this->argument('model');
      if($this->checkIfRepositoryExists($model)) return false;
      
      $className      = $model.'Repository';
      $classContainer = "<?php\n\nnamespace App\Repositories;\n\nuse App\Models\\$model;\n\nclass $className extends Repository {\n\n\tpublic function __construct()\n\t{\n\t\tparent::__construct($model::class);\n\t} \n}\n";
      $path           = app_path('Repositories/'.$className.'.php');
      file_put_contents($path, $classContainer);
      $this->line("  <bg=blue;fg=white> INFO </> Repository [app/Repositories/$className] created successfully\n");
    }

    private function checkIfRepositoryExists($model)
    {
      $className = $model.'Repository';
      $path      = app_path('Repositories/'.$className.'.php');
      if (file_exists($path)) {
        $this->line("  <error> ERROR </error> Repository already exists\n");
        return true;
      }
      return false;
    }
}
