<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/posts', function (Request $request) {
    Log::info('GET /posts');
    // get the user
    $user = $request->user();
    Log::info('user: ' . $user->email);
    $posts = Post::all();
    return response()->json($posts);
})->middleware('auth:sanctum');

// create a post
Route::post('/posts', function (Request $request) {

    //validate 
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);
    Log::info('POST /posts');
    // get the user
    $user = $request->user();
    Log::info('user: ' . $user->email);
    $post = new Post();
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->save();
    return response()->json([
        'message' => __('model.created'),
        'post' => $post,
    ]);
})->middleware('auth:sanctum');
