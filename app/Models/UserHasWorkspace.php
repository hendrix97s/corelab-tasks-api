<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserHasWorkspace extends Pivot
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'workspace_id',
  ];
}
