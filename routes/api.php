<?php

use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('task/{id}', function (string $id) {
    return new TaskResource(Task::findOrFail($id));
});
Route::get('/task', function () {
    return TaskResource::collection(Task::all());
});

// Route::get('task', [TaskController::class, 'list']);
