<?php

Route::get('/', function() {
    return redirect(route('posts.index'));
});

Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController');
Route::resource('users', 'UsersController');

Route::resource('admin-posts', 'AdminPostsController');
Route::post('admin-posts/{post}/publish', 'AdminPostsController@publish')->name('admin-posts.publish');
Route::post('admin-posts/{post}/unpublish', 'AdminPostsController@unpublish')->name('admin-posts.unpublish');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
