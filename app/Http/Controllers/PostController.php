<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	    {
		    try{
			    $posts = Post::with('comments:post_id,cmt,created_at')->get();

		return response()->json([
			"data" => $posts, 
			"error" => false,
			"message" =>""
		],200);
	    }catch(\Throwable $e){
		    return response()->json([
		    	"data" => null,
			"error" => true,
		       	"message" => $e->getMessage()	
		    ],400);
	    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	    $message_errors = [
                        'required' => 'the :attribute field is required.'
                ];

                $validator = Validator::make($request->all(),[
                        "title" => 'required',
                        "short_desc" => 'required',
                        "desc" => 'required'
                ], $message_errors);

                if($validator->fails()){
                        return response()->json([
                                "data" => null,
                                "error" => true,
                                "message" => $validator->errors()
                        ],400);
		}

	    $post = Post::create([
			"title" => $request->title,
			"short_desc" => $request->short_desc,
			"desc" => $request->desc
		]);

		return response()->json([
                                "data" => $post,
                                "error" => false,
                                "message" => "Post created successfully"
                        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    try{
	   	$post = Post::with('comments:post_id,cmt,created_at')->findOrFail($id); 
	    }catch(\Throwable $e){
		return response()->json([
                        "data" => null,
                        "error" => true,
                        "message" => "Post Not Found"
                    	],400);
	    }

	    return response()->json([
                        "data" => $post,
                        "error" => false,
                        "message" => ""
                        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
    	$message_errors = [
                        'required' => 'the :attribute field is required.'
                ];

                $validator = Validator::make($request->all(),[
                        "title" => 'required',
                        "short_desc" => 'required',
                        "desc" => 'required'
                ], $message_errors);

                if($validator->fails()){
                        return response()->json([
                                "data" => null,
                                "error" => true,
                                "message" => $validator->errors()
                        ],400);
		}

		$post->update($request->all());
		
		return response()->json([
                                "data" => $post,
                                "error" => false,
                                "message" => "Post updated successfully"
                        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
	    $post->delete();

	    return response()->json([
                                "data" => $post,
                                "error" => false,
                                "message" => "Post deleted successfully"
                        ],200);
    }

}
