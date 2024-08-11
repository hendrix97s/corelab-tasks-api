<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'status_id',
    'project_id',
    'workspace_id',
    'expires_at',
    'priority',
    'assignee_id',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
    'pivot'
  ];

  protected $appends = [
    'status',
    'project',
    'workspace',
    'assignable'
  ];

  public function assignable()
  {
    return $this->hasOne(User::class, 'id', 'assignee_id');
  }

  public function status()
  {
    return $this->hasOne(Status::class, 'id', 'status_id');
  }

  public function project()
  {
    return $this->hasOne(Project::class, 'id', 'project_id');
  }

  public function workspace()
  {
    return $this->hasOne(Workspace::class, 'id', 'workspace_id');
  }

  public function getStatusAttribute()
  {
    return $this->status()->first();
  }

  public function getProjectAttribute()
  {
    return $this->project()->first();
  }

  public function getWorkspaceAttribute()
  {
    return $this->workspace()->first();
  }

  public function getAssignableAttribute()
  {
    return $this->assignable()->first();
  }
}
