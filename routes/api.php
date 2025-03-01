<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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
        Route::post("/posts", [PostController::class, "store"]);
    });
});
