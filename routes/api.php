<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('posts', 'Api\PostsController');

Route::get('/users/{user}/posts', 'Api\PostsController@forUser');

Route::get('/posts/{post}/comments', 'Api\CommentsController@forPost');
Route::post('/posts/{post}/comments', 'Api\CommentsController@store');
Route::put('/comments/{comment}', 'Api\CommentsController@update');
Route::delete('/comments/{comment}', 'Api\CommentsController@destroy');
