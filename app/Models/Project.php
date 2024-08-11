<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'workspace_id',
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
    'pivot'
  ];

  protected $appends = [
    'statuses'
  ];

  public function statuses()
  {
    return $this->hasMany(Status::class);
  }

  public function getStatusesAttribute()
  {
    return $this->statuses()->get();
  }
}
