<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostStoreRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::select('posts.id', 'users.name', 'posts.description', 'posts.created_at')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->orderBy('created_at')
            ->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $request->validated();
        $user = auth()->user();
        $created_post = Post::create([
            'description' => $request->description,
            'user_id' => $user->id
        ]);
        return new PostResource((object) [
            "id" => $created_post->id,
            'name' => $user->name,
            'description' => $created_post->description,
            'created_at' => $created_post->created_at
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) // TO DO пофиксить лишние запросы к бд и с мидлваре
    {

        $validated = (object) $request->validate([
            'id' => [
                'required',
                'numeric',
                Rule::exists('posts', 'id')
            ],
        ]);
        $user = auth()->user();
        $post = Post::where('id', $validated->id)->first();

        if ($post->user_id !== $user->id) {
            return response()->json([
                'message' => 'Попытка удаления чужого поста',
            ], 403);
        }

        if (now()->subHours(24) > $post->created_at) {
            return response()->json([
                'message' => 'Сообщение существует более 24 часов',
            ], 418);
        }

        $post->delete();

        return new PostResource((object) [
            "id" => $post->id,
            'name' => $user->name,
            'description' => $post->description,
            'created_at' => $post->created_at
        ]);
    }
}
