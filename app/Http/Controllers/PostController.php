<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Paginate the posts
        $posts = Post::paginate(10); // You can change 10 to the number of posts per page you want

        // Pass the paginated posts to the view
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(PostCreateRequest $request)
    {
        // Validate the incoming request data
        $validatedData = $request->only(['title', 'body']);
    
        // Add the logged-in user's ID to the validated data
        $validatedData['user_id'] = auth()->id();
        // Create the new post with the validated data
        $post = Post::create($validatedData);
        // Handle image if it exists
        if ($request->hasFile('image')) {
            // Add new image to the 'images' collection
            $post->addMediaFromRequest('image')
                ->toMediaCollection('images', 'public');
        }
    
        // Redirect to the posts index route
        return redirect()->route('posts.index');
    }
    

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(PostCreateRequest $request, Post $post)
    {
        $validatedData = $request->only(['title', 'body']);
    
        // Add the logged-in user's ID to the validated data
        $validatedData['user_id'] = auth()->id();
        // Handle image if exists
        if ($request->hasFile('image')) {
            // Clear previous media
            $post->clearMediaCollection('images');

            // Add new image to the 'images' collection
            $post->addMediaFromRequest('image')
                ->toMediaCollection('images', 'public');
        }

        return redirect()->route('posts.index');
    }

    public function delete(Post $post)
    {
        // Clear and delete post media
        $post->clearMediaCollection('images');
        $post->delete();

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }
}

