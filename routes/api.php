<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/posts', PostController::class);
Route::post('/comments', [CommentController::class, 'store']);
Route::post('/likes', [LikeController::class, 'store']);

