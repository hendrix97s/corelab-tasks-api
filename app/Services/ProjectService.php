<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectService
{

  protected ProjectRepository $repository;

  public function __construct()
  {
    $this->repository = new ProjectRepository();
  }

  public function create(int $workspace, array $data)
  {
    DB::beginTransaction();

    try {

      $project =  $this->repository->createByWorkspace($workspace, $data);
      if ($project instanceof Project && isset($data['statuses'])) {
        $this->createStatuses($project, $data['statuses']);
      }

      DB::commit();
      return $project->fresh();
    } catch (\Throwable $th) {
      DB::rollBack();
      return false;
    }
  }

  public function createStatuses(Project $project, $data)
  {
    foreach ($data as $status) {
      $project->statuses()->create([
        'workspace_id' => $project->workspace_id,
        'project_id'   => $project->id,
        'name'         => $status['name'],
        'color'        => $status['color'],
      ]);
    }
  }
}
