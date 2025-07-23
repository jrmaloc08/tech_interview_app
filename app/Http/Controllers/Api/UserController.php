<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = UserResource::collection(User::all());

        return response()->json([
            'data' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'username' => 'required|string|max:255|unique:users',
        ]);

        // Create user
        $user = User::create([
            'name' => ucwords(strtolower($validated['name'])),
            'email' => strtolower($validated['email']),
            'password' => Hash::make($validated['password']),
            'username' => $validated['username'],
        ]);

        // Optional: log them in
        Auth::login($user);

        // Return response
        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = new UserResource(User::findOrFail($id));

        return response()->json([
            "data" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate only the fields that are present
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
            'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Format fields if present
        if (isset($validated['name'])) {
            $validated['name'] = ucwords(strtolower($validated['name']));
        }

        if (isset($validated['email'])) {
            $validated['email'] = strtolower($validated['email']);
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Update only the validated fields
        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            "data" => 'User deleted successfully.',
        ]);
    }
}
