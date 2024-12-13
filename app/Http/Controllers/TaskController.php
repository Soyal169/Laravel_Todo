<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', compact('tasks'));

    }
    public function create()
    {
        return view('task.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'desc' => 'required|string|max:255',

        ]);
        Task::create([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);
        return redirect('task');
    }
    public function edit(Task $task)
    {
        return view('task.edit', data: compact('task'));
    }
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);
        $task->update($data);

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    public function delete(Task $task)
    {
        $task->delete();
        return redirect('/task');
    }
}
