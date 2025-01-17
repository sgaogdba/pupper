<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Http\Resources\Post as PostResource;
use App\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Renderable
    {
        return view('posts.create');
    }

    /**
     * Store a newly-created post.
     */
    public function store(CreatePost $request): RedirectResponse
    {
        $post = $request->user()->posts()
            ->save(new Post($request->validated()));

        return redirect(route('posts.show', ['post' => $post]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): Renderable
    {
        return view('posts.show')->with([
            'post' => new PostResource($post),
        ]);
    }
}
