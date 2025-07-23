<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class GetAllController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $models = [
            'users' => User::class,
            'posts' => Post::class,
            'comments' => Comment::class,
            'albums' => Album::class,
            'photos' => Photo::class,
            'todos' => Todo::class,
        ];

        $data = [];

        foreach ($models as $key => $modelClass) {
            $data[$key] = $modelClass::all();
        }

        return response()->json([
            'data' => [$data] // wrap the associative array in another array
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
