<?php

namespace App\Repositories;

use App\Models\TaskList;

class TaskListRepository extends Repository
{

  public function __construct()
  {
    parent::__construct(TaskList::class);
  }

  public function getByWorkspaceAndProject(int $workspaceId, int $projectId)
  {
    return $this->model
      ->where('workspace_id', $workspaceId)
      ->where('project_id', $projectId)
      ->get();
  }

  public function updateByWorkspaceAndProject(int $workspaceId, int $projectId, array $data)
  {
    $taskList = $this->model
      ->where('workspace_id', $workspaceId)
      ->where('project_id', $projectId)
      ->update($data);

    return ($taskList) ? $taskList->fresh() : false;
  }

  public function deleteByWorkspaceAndProject(int $workspaceId, int $projectId, int $taskListId)
  {
    return $this->model
      ->where('workspace_id', $workspaceId)
      ->where('project_id', $projectId)
      ->where('id', $taskListId)
      ->delete();
  }

  public function findByWorkspaceAndProject(int $workspaceId, int $projectId, int $taskListId)
  {
    return $this->model
      ->where('workspace_id', $workspaceId)
      ->where('project_id', $projectId)
      ->where('id', $taskListId)
      ->with('project')
      ->first();
  }
}
