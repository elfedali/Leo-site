<?php

use App\Models\Node;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

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
// login
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
// register
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
// logout
Route::post('/logout', 'App\Http\Controllers\Api\AuthController@logout');

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


// get user restaurants
Route::get('/restaurants', function (Request $request) {
    Log::info('GET /restaurants');
    // get the user
    $user = $request->user();
    Log::info('user: ' . $user->email);
    $restaurants = $user->nodes()->where('type', 'restaurant')->get();
    return response()->json($restaurants);
})->middleware('auth:sanctum');

// get restaurant by id
Route::get('/restaurants/{id}', function (Request $request, $id) {
    // Todo: validate id and check if the restaurant belongs to the user
    Log::info('GET /restaurants/' . $id);
    // get the user
    $user = $request->user();
    Log::info('user: ' . $user->email);
    $restaurant = $user->nodes()->where('type', 'restaurant')->where('id', $id)->first();
    return response()->json($restaurant);
})->middleware('auth:sanctum');

// update restaurant by id
Route::put('/restaurants/{node}', function (Request $request, Node $node) {

    //validate 
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);
    Log::info('PUT /restaurants/' . $node->id);
    // get the user
    $user = $request->user();
    Log::info('user: ' . $user->email);
    $node->update($request->all());
    return response()->json([
        'message' => __('model.updated'),
        'restaurant' => $node,
    ]);
})->middleware('auth:sanctum');





// Use json api routes
JsonApiRoute::server('v1')
    ->prefix('v1')
    ->resources(function (ResourceRegistrar $server) {
        $server->resource('nodes', JsonApiController::class)->readOnly();
        $server->resource('users', JsonApiController::class)->readOnly();
        // $server->resource('posts', JsonApiController::class);

        // $server->resource('menu-categories', JsonApiController::class);
    });


Route::apiResource('/restaurants/{node}/menu-category', App\Http\Controllers\MenuCategoryController::class)
    ->middleware('auth:sanctum');
