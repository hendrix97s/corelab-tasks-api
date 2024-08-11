<?php

namespace App\Repositories;

use App\Models\Workspace;

class WorkspaceRepository extends Repository
{

  public function __construct()
  {
    parent::__construct(Workspace::class);
  }
}
