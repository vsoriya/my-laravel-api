<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use \Illuminate\Support\Facades\Auth;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::with('user', 'category', 'comments.user', 'likes')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',   
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
        ]);
        
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'user_id'     => Auth::id() ?? $request->user_id ?? 1,
            'category_id' => $request->category_id 
        ]);
        return response()->json($post->load('user', 'category', 'comments','likes'), 201);
    }

    /**
     * 
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $post = Post::with(['user', 'category', 'comments.user', 'likes'])->find($id);

        if (!$post) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($post, 200);
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
