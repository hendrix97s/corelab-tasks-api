<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository extends Repository
{

  public function __construct()
  {
    parent::__construct(Task::class);
  }

  public function getTasksByWorkspaceAndProjectAndTaskList(int $workspaceId, int $projectId, int $taskListId)
  {
    return $this->model
      ->where('workspace_id', $workspaceId)
      ->where('project_id', $projectId)
      ->where('task_list_id', $taskListId)
      ->get();
  }

  public function updateTaskByWorkspaceProjectAndTaskList(int $workspaceId, int $projectId, int $taskListId, int $id, array $data)
  {
    $task = $this->model
      ->where('workspace_id', $workspaceId)
      ->where('project_id', $projectId)
      ->where('task_list_id', $taskListId)
      ->where('id', $id)
      ->first();

    return ($task->update($data)) ? $task->fresh() : false;
  }
}
