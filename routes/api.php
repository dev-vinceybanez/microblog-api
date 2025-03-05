<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShareController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware(["api-key"])->group(function () {
    Route::post("/register", [AuthController::class, "store"]);
    Route::post("/login", [AuthController::class, "index"]);

    Route::middleware(["auth:sanctum"])->group(function () {
        Route::get("/posts", [PostController::class, "index"]);
        Route::get("/posts/{post}", [PostController::class, "show"]);
        Route::post("/posts", [PostController::class, "store"]);
        Route::put("/posts/{post}", [PostController::class, "update"]);
        Route::delete("/posts/{post}", [PostController::class, "destroy"]);
        Route::post("/posts/{post}/likes", [LikeController::class, "likeUnlike"]);
        Route::post("/posts/{post}/comments", [CommentController::class, "store"]);
        Route::get("/posts/{post}/comments", [CommentController::class, "index"]);
        Route::middleware(["comment-owner", "comment-belongsto-post"])->group(function () {
            Route::put("/posts/{post}/comments/{comment}", [CommentController::class, "update"]);
            Route::delete("/posts/{post}/comments/{comment}", [CommentController::class, "destroy"]);
        });
        Route::post("/posts/{post}/share", [ShareController::class, "store"]);
        Route::post("/users/{user}/follow", [FollowController::class, "followUnfollow"])->middleware("self-follow");
    });
});
