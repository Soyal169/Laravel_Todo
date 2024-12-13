@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Your Tasks</h1>
    <div class="mt-6">
        <a href="{{ route('task.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Task</a>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        @if($tasks->isEmpty())
            <p class="text-gray-500">You have no tasks.</p>
        @else
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left">Title</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left text-xs">Completed</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="border-t border-gray-300">
                        <td class="py-3 px-6">{{ $task->title }}</td>
                        <td class="py-3 px-6">{{ $task->desc }}</td>
                        <td class="py-3 px-6 text-xs {{ $task->is_completed ? 'bg-green-200' : 'bg-red-200' }} text-center">{{ $task->is_completed ? 'Yes' : 'No' }}</td>
                        <td class="py-3 px-6 flex">
                            <a href="{{ route('task.edit', $task->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3">Edit</a>
                            <form action="{{ route('task.delete', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
</div>
@endsection

