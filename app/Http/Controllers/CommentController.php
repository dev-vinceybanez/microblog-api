<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentIndexRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentResourceCollection;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(CommentIndexRequest $commentIndexRequest, Post $post)
    {
        $perPage = $commentIndexRequest->per_page;

        $comments = $post->comments()->latest()->paginate($perPage);

        return CommentResourceCollection::make($comments);
    }

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

    public function update(CommentUpdateRequest $commentUpdateRequest, Post $post, Comment $comment)
    {
        $validated = $commentUpdateRequest->validated();

        $comment->update([
            "body" => $validated["body"]
        ]);

        return response($comment, 200);
    }
}
