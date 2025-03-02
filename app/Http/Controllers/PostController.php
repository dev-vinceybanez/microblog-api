<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostIndexRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(PostIndexRequest $postCreateRequest)
    {
        $perPage = $postCreateRequest->per_page;
        $search = $postCreateRequest->search;

        $posts = Post::with("user")
            ->search($search)
            ->latest()
            ->paginate($perPage);

        return PostCollection::make($posts);
    }

    public function store(PostCreateRequest $postCreateRequest)
    {
        $validated = $postCreateRequest->validated();

        $imagePath = null;

        if ($postCreateRequest->hasFile("image")) {
            $fileExtension = $postCreateRequest->file("image")->getClientOriginalExtension();
            $filename = time() . "." . $fileExtension;
            $imagePath = $postCreateRequest->file("image")->storeAs("posts", $filename, "public");
        }

        $post = Post::create([
            "body" => $validated["body"],
            "image" => $imagePath,
            "user_id" => $postCreateRequest->user()->id
        ]);

        return response()->json($post, 201);
    }

    public function update(PostUpdateRequest $postUpdateRequest, Post $post)
    {
        $validated = $postUpdateRequest->validated();

        $imagePath = null;

        if ($postUpdateRequest->hasFile("image")) {
            $fileExtension = $postUpdateRequest->file("image")->getClientOriginalExtension();
            $filename = time() . "." . $fileExtension;
            $imagePath = $postUpdateRequest->file("image")->storeAs("posts", $filename, "public");
        }

        $validated["image"] = $imagePath;
        $post->update($validated);

        return response()->json($post, 200);
    }
}
