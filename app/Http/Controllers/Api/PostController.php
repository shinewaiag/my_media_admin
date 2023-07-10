<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get posts
    public function posts() {
        $post = Post::get();
        return response()->json([
            'post' => $post
        ]);
    }

    //search posts
    public function search(Request $request) {
        $post = Post::where('title', 'like', '%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $post
        ]);
    }

    //get post details
    public function details(Request $request) {
        $id = $request->postId;
        $post = Post::where('post_id', $id)->first();
        return response()->json([
            'post' => $post
        ]);
    }
}
