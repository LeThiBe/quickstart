<?php

namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository
{
  public function forUser(User $user)
  {
    return $user->tasks;
  }

  public function recent(User $user) {
    return $user->tasks()->recent()->get();
  }
}