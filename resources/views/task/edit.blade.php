@extends('layouts.apps')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Task</h1>
        <div class="bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('task.update', $task) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Title</label>
                    <input type="text" id="title" name="title" value="{{ $task->title }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="desc"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                    <textarea id="desc" name="desc"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        rows="3">{{ $task->desc }}</textarea>
                </div>
                <div class="mb-6">
                    <label for="image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Image</label>
                    <input type="file" id="image" name="image"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        accept="image/*" />
                    <td class="py-3 px-6 text-center">
                        @if ($task->getFirstMediaUrl('images'))
                            <img src="{{ $task->getFirstMediaUrl('images') }}" alt="Task Image"
                                class="h-48 w-48 object-cover" />
                        @else
                            <p>No image available</p>
                        @endif
                    </td>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </form>
        </div>
    </div>
@endsection
