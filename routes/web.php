<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// new node
Route::get('/new-node', function () {
    $node = new \App\Models\Node();
    $node->owner_id = 1;
    $node->title = 'New Node';
    $node->content = 'This is a new node';
    $node->save();
    return $node;
});
