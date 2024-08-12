<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends Repository
{

  public function __construct()
  {
    parent::__construct(Comment::class);
  }

  public function getByTask(int $taskId)
  {
    return $this->model->where('task_id', $taskId)->get();
  }
}
