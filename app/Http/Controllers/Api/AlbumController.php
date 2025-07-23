<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $albums = Album::orderBy("id","desc")->paginate(10);

        return response()->json([
            "data" => $albums
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validate = $request->validate([
            "user_id" => "required|exists:users,id",
            "title" => "required|string|max:255",
        ]);

        $album = Album::create($validate);

        return response()->json([
            "data" => [
                "album" => $album,
                "message" => "Album created successfully."
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $album = Album::findOrFail($id);

        return response()->json([
            "data"=> $album
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validate = $request->validate([
            "title" => "sometimes|string|max:255",
        ]);

        $album = Album::findOrFail($id);

        $album->update($validate);

        return response()->json([
            "data" => [
                "album" => $album,
                "message" => "Album updated successfully."
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $album = Album::findOrFail($id);

        $album->delete();

        return response()->json([
            "data" => [
                "message" => "Album deleted successfully."
            ]
        ]);
    }
}
