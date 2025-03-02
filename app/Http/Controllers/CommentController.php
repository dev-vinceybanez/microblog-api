<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentCreateRequest $commentCreateRequest, Post $post)
    {
        $validated = $commentCreateRequest->validated();

        $comment = Comment::create([
            "body" => $validated["body"],
            "post_id" => $post->id,
            "commenter_id" => auth()->user()->id
        ]);

        return response($comment, 201);
    }
}
