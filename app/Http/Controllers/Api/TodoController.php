<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $todo = Todo::orderBy("id","desc")->paginate(10);

        return response()->json([
            "data" => $todo
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
            "completed" => "required|boolean",
        ]);

        $todo = Todo::create($validate);

        return response()->json([
            "data" => [
                "todo" => $todo,
                "message" => "Task created successfully."
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $todo = Todo::findOrFail($id);

        return response()->json([
            "data" => $todo
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
            "completed" => "sometimes|boolean",
        ]);

        $todo = Todo::findOrFail($id);

        $todo->update($validate);

        return response()->json([
            "data" => [
                "todo" => $todo,
                "message" => "Task updated successfully."
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $todo = Todo::findOrFail($id);

        $todo->delete();

        return response()->json([
            "data" => [
                "message" => "Task deleted successfully."
            ]
        ]);
    }
}
