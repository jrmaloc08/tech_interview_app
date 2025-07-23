<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $photos = Photo::all();

        return response()->json([
            "data" => $photos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            "album_id" => "required|exists:albums,id",
            "title" => "required|string|max:255",
            "url" => "required|url",
            "thumbnail_url" => "required|url",
        ]);

        $photo = Photo::create($validate);

        return response()->json([
            "data" => [
                "photo" => $photo,
                "message" => "Photo created successfully."
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $photo = Photo::findOrFail($id);

        return response()->json([
            "data" => $photo
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
            "url" => "sometimes|url",
            "thumbnail_url" => "sometimes|url",
        ]);

        $photo = Photo::findOrFail($id);

        $photo->update($validate);

        return response()->json([
            "data" => [
                "photo" => $photo,
                "message" => "Photo updated successfully."
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $photo = Photo::findOrFail($id);
        $photo->delete();

        return response()->json([
            "data"=> [
                "message" => "Photo deleted successfully.",
            ]
        ]);
    }
}
