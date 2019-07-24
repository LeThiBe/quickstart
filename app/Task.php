<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
  protected $fillable = ['name', 'deadline'];

  use SoftDeletes;

  public function user()
  {
      return $this->belongsTo(User::class);
  }

  public function scopeRecent($query)
  {
    return $query->orderBy('created_at', 'desc');
  }
}
