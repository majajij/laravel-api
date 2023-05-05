<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $comment = Comment::create([
                'post_id' => $request->post_id,
                'cmt' => $request->comment,
            ]);

            return response()->json([
                'data' => $comment,
                'error' => false,
                'message' => '',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        try {
            $comment->update([
                'cmt' => $request->comment,
            ]);

            return response()->json([
                'data' => $comment,
                'error' => false,
                'message' => '',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();

            return response()->json([
                'data' => $comment,
                'error' => false,
                'message' => '',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
