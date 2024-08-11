<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
  use HasFactory;

  protected $fillable = [
    'workspace_id',
    'project_id',
    'name',
  ];

  protected $hidden = [
    'workspace_id',
    'project_id',
    'created_at',
    'updated_at',
  ];

  public function project()
  {
    return $this->belongsTo(Project::class, 'project_id', 'id');
  }
}
