@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Add Task</h1>
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Task Title:</label>
                <input type="text" name="title" id="title" placeholder="Enter task title" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="desc" class="block text-gray-700 text-sm font-bold mb-2">Task Description:</label>
                <textarea name="desc" id="desc" rows="4" placeholder="Enter task description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    onclick="this.form.submit(); this.form.reset(); ">
                    Add Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

