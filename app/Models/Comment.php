<?php

namespace App\Models;

use App\Observers\CommentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[ObservedBy([CommentObserver::class])]
class Comment extends Model
{
  use HasFactory;

  protected $fillable = [
    'content',
    'task_id',
    'user_id',
  ];

  protected $hidden = [
    'user_id',
    'created_at',
    'updated_at',
  ];

  protected $appends = [
    'user',
  ];

  public function user()
  {
    return $this->hasOne(User::class, 'id', 'user_id');
  }

  public function getUserAttribute()
  {
    return $this->user()->first();
  }
}
