<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function followUnfollow(User $user)
    {
        $follower = auth()->user();

        // Check if already following
        $follow = Follow::withTrashed()
            ->where("following_id", $user->id)
            ->where("follower_id", $follower->id)
            ->first();

        if ($follow) {
            if ($follow->trashed()) {
                $follow->restore();

                return response()->json("Followed again", 200);
            }

            $follow->delete();
            return response()->json("Unfollowed", 200);
        }

        $follow = Follow::create([
            "following_id" => $user->id,
            "follower_id" => auth()->user()->id
        ]);

        return response()->json("Following", 201);
    }
}
