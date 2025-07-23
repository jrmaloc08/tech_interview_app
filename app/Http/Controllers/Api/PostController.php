<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::orderBy("created_at","desc")->paginate(10);

        return response()->json([
            "data" => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::create($validate);

        return response()->json([
            "data" => [
                "post" => $post,
                "message" => "Post created successfully."
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $post = Post::find($id);

        return response()->json([
            "data" => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validate = $request->validate([
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
        ]);

        $post = Post::find($id);

        $post->update($validate);

        return response()->json([
            "data" => [
                "post" => $post,
                "message" => "Post updated successfully."
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::findOrFail($id);

        $post->delete();

        return response()->json([
            "data" => [
                "message" => "Post deleted successfully."
            ]
        ]);
    }
}
