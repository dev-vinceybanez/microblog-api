<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostShareRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function store(PostShareRequest $postShareRequest, Post $post)
    {
        $validated = $postShareRequest->validated();

        $sharedPost = Post::create([
            "body" => $validated["body"],
            "post_id" => $post->id,
            "user_id" => auth()->user()->id,
        ]);

        return response()->json($sharedPost, 201);
    }
}
