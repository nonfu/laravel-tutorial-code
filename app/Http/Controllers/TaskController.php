<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function home()
    {
        return 'Hello, Controller!';
    }

    public function index()
    {
        dd('tasks');
        return view('task.index')->with('tasks', Task::all());
    }

    public function index2()
    {
        dd('tasks2');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();
        return redirect('task');
    }
}
