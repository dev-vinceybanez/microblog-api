<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
}
