@extends('layouts.apps')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">Your Tasks</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            @if ($tasks->isEmpty())
                <p class="text-gray-500">You have no tasks.</p>
            @else
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left">Title</th>
                            <th class="py-3 px-6 text-left">Description</th>
                            <th class="py-3 px-6 text-left text-xs">Completed</th>
                            <th class="py-3 px-6 text-left">Image</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            @if (Auth::user()->id == $task->user_id)
                                <tr class="border-t border-gray-300">
                                    <td class="py-3 px-6">{{ $task->title }}</td>
                                    <td class="py-3 px-6">{{ $task->desc }}</td>
                                    <td class="py-3 px-6 text-xs text-center">
                                        @if ($task->is_completed)
                                            <form action="{{ route('task.uncomplete', $task) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Uncomplete</button>
                                            </form>
                                        @else
                                            <form action="{{ route('task.complete', $task) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Complete</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if ($task->getFirstMediaUrl('images'))
                                            <img src="{{ $task->getFirstMediaUrl('images') }}" alt="Task Image"
                                                class="h-48 w-48 object-cover" />
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 flex">
                                        <a href="{{ route('task.edit', $task->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-3">Edit</a>
                                        <form action="{{ route('task.delete', $task) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

@endsection
