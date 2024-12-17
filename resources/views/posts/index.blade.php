@extends('layouts.apps')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center">My Posts</h1>

        @if ($posts->count() > 0)
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4 text-left">Title</th>
                            <th class="py-2 px-4 text-left">Description</th>
                            <th class="py-2 px-4 text-center">Image</th>
                            <th class="py-2 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            @if ($post->user_id === auth()->id())
                                <tr class="border-b">
                                    <td class="py-4 px-4">{{ $post->title }}</td>
                                    <td class="py-4 px-4 text-gray-600">{{ Str::limit($post->body, 100) }}</td>
                                    <td class="py-4 px-4 text-center">
                                        @if ($post->getFirstMediaUrl('images'))
                                            <img src="{{ $post->getFirstMediaUrl('images') }}" alt="Post Image"
                                                class="h-48 w-48 object-cover" />
                                        @else
                                            <p>No image available</p>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-right">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="text-blue-500 hover:text-blue-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="mt-6 flex justify-center">
                    {{ $posts->links('pagination::tailwind') }}
                </div>
            </div>
        @else
            <div class="text-center text-gray-600">
                <p class="text-xl font-semibold">No posts found.</p>
            </div>
        @endif
    </div>
@endsection
