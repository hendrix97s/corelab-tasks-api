<?php

namespace App\Services;

use App\Models\Project;
use App\Models\TaskList;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Log;

class TaskService
{

  protected TaskRepository $repository;

  public function __construct()
  {
    $this->repository = new TaskRepository();
  }

  public function create(int $workspaceId, int $projectId, int $taskListId, array $data)
  {
    $project = Project::where('workspace_id', $workspaceId)->where('id', $projectId)->first();
    $taskList = TaskList::where('workspace_id', $workspaceId)->where('project_id', $projectId)->where('id', $taskListId)->first();

    if (!$project || !$taskList) return false;

    return $this->repository->create([
      ...$data,
      'workspace_id' => $workspaceId,
      'project_id'   => $projectId,
      'task_list_id' => $taskListId
    ]);
  }
}
