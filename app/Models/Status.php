<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  use HasFactory;

  protected $fillable = [
    'workspace_id',
    'project_id',
    'name',
    'color',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
    'pivot'
  ];
}
