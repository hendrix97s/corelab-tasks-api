<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
    'pivot'
  ];

  public function users()
  {
    return $this->belongsToMany(User::class, 'user_has_workspaces', 'workspace_id', 'user_id');
  }
}
