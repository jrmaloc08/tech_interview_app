<?php

use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\GetAllController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('/create-token', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return new UserResource($request->user());
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class)->except(['store']);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('todos', TodoController::class);
    Route::apiResource('albums', AlbumController::class);
    Route::apiResource('photos', PhotoController::class);
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('get-all', GetAllController::class);
});

Route::post('/users', [UserController::class, 'store'])->name('users.store');