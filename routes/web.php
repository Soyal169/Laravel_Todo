<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('task')->name('task.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/store', [TaskController::class, 'store'])->name('store');
        Route::put('/complete/{task}', [TaskController::class, 'complete'])->name('complete');
        Route::put('/uncomplete/{task}', [TaskController::class, 'uncomplete'])->name('uncomplete');
        Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('edit');
        Route::put('/update/{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('/delete/{task}', [TaskController::class, 'delete'])->name('delete');
    });
});
Route::get('/post', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/post', [PostController::class, 'store'])->name('posts.store');
Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/post/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/post/{post}', [PostController::class, 'delete'])->name('posts.destroy');


require __DIR__ . '/auth.php';
