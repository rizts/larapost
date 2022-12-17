<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('access posts')) {
            $posts = Post::latest()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Fetch posts success',
                'data' => PostResource::collection($posts),
            ]);
        } else {
            $posts = Post::where('creator', auth()->user()->id)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Fetch posts success',
                'data' => PostResource::collection($posts),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->cannot('create posts')) {
            return response()->json([
                'status' => 'error',
                'message' => 'You don\'t have authorize to create a post.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:155',
            'content' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ]);
        }

        $post = Post::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'status' => $request->get('status'),
            'slug' => Str::slug($request->get('title')),
            'creator' => $request->get('creator'),
        ]);

        return response()->json([
            'status' => 'success',
            'data' => new PostResource($post),
            'message' => 'Post created successfully.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data post not found',
            ]);
        }

        if (auth()->user()->can('access posts')) {
            return response()->json([
                'status' => 'success',
                'data' => new PostResource($post),
                'message' => 'Data post found',
            ]);
        } else {
            if ($post->creator == auth()->user()->id) {
                return response()->json([
                    'status' => 'success',
                    'data' => new PostResource($post),
                    'message' => 'Data post found',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You don\'t have authorize to view this post.',
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data post not found',
            ]);
        }

        $can = (auth()->user()->can('update posts')?true : ($post->creator == auth()->user()->id)? true: false);

        if ($can) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:155',
                'content' => 'required',
                'creator' => 'required',
                'status' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ]);
            }

            $post->update([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'status' => $request->get('status'),
                'slug' => Str::slug($request->get('title')),
                'creator' => $request->get('creator'),
            ]);

            return response()->json([
                'status' => 'success',
                'data' => new PostResource($post),
                'message' => 'Post updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You don\'t have authorize to update this post.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data post not found',
            ]);
        }

        $can = (auth()->user()->can('delete posts')?true : ($post->creator == auth()->user()->id)? true: false);

        if ($can) {
            $post->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Post deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You don\'t have authorize to delete this post.',
            ]);
        }
    }
}
