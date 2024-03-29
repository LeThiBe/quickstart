<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;
use App\Task;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->recent($request->user()),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'deadline' => 'required|date|after_or_equal:today',
        ]);
        $task = $request->user()->tasks()->create([
            'name'=>$request -> name,
            'deadline'=>$request -> deadline,
        ]);
        return redirect('tasks');
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');
    }
}
