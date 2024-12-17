<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', compact('tasks'));

    }
    public function create()
    {
        return view('task.create');
    }
    public function store(TaskCreateRequest $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'is_completed' => true,
            'user_id' => auth()->id(),
        ]);
        if ($request->hasFile('image')) {
            $task->addMediaFromRequest('image')
                ->toMediaCollection('images', 'public');
        }
        return redirect('task');
    }
    public function complete(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        $task->update(['is_completed' => true]);
        return redirect('task');
    }
    public function uncomplete(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        $task->update(['is_completed' => false]);
        return redirect('task');
    }


    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('task.edit', data: compact('task'));
    }

   public function update(TaskCreateRequest $request, Task $task)
{
    // Ensure the task belongs to the logged-in user (optional security measure)
    if ($task->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    // Update the task with the validated data
    $task->update([
        'title' => $request->title,
        'desc' => $request->desc,
        'is_completed' => true,
    ]);

    // If the request has a new image, replace the old image
    if ($request->hasFile('image')) {
        // Clear the old media collection (if any)
        $task->clearMediaCollection('images');
        
        // Add new media from the request
        $task->addMediaFromRequest('image')
            ->toMediaCollection('images', 'public');
    }

    return redirect()->route('task.index')->with('success', 'Task updated successfully.');
}
    public function delete(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        $task->clearMediaCollection('images');
        $task->delete();
        return redirect('/task');
    }
}

