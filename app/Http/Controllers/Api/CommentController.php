<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $comments = Comment::orderBy("id","desc")->paginate(10);
        return response()->json([
            "data" => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'body' => 'required|string',
        ]);

        $comment = Comment::create($validate);

        return response()->json([
            "data" => [
                "comment" => $comment,
                "message" => "Comment created successfully."
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $comment = Comment::findOrFail($id);

        return response()->json([
            "data" => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $validate = $request->validate([
            "name" => "sometimes|string|max:255",
            "body" => "sometimes|string",
        ]);

        $comment = Comment::findOrFail($id);

        $comment->update($validate);

        return response()->json([
            "data" => [
                "comment" => $comment,
                "message" => "Comment updated successfully."
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $comment = Comment::findOrFail($id);

        $comment->delete();

        return response()->json([
            "data" => [
                "message" => "Comment deleted successfully."
            ]
        ]);
    }
}
