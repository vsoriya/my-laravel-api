<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $existingLike =  Like::where('post_id', $request->post_id)
            ->where('user_id', $request->user_id)
            ->first();
        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['message' => 'Unlike successful'], 200);
        } else {
            Like::create([
                'post_id' => $request->post_id,
                'user_id' => $request->user_id
            ]);
            return response()->json(['message' => 'Like successful'], 201);
        }
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
