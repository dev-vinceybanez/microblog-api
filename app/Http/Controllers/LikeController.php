<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeUnlike(Post $post)
    {
        $likeExists = $post->likes()
            ->where("liker_id", auth()->user()->id)
            ->first();

        if ($likeExists) {
            $likeExists->delete();

            return response()->json("Unliked", 200);
        }

        $like = Like::create([
            "post_id" => $post->id,
            "liker_id" => Auth::user()->id,
        ]);

        return response()->json($like, 201);
    }
}
