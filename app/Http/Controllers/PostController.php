<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use \Illuminate\Support\Facades\Auth;

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
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'user_id'     => $request->user_id ?? Auth::id() ?? 1,
            'category_id' => $request->category_id 
        ]);
        return response()->json($post->load('user', 'category'), 201);
    }

    /**
     * 
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
