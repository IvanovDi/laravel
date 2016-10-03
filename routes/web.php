<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('create', [
    'as' => 'create',
    'uses' => 'PostController@create'
]);

Route::get('save', [
    'as' => 'save',
    'uses' => 'PostController@save'
]);

Route::get('showPost/{id}', [
    'as' => 'showPost',
    'uses' => 'PostController@showPost'
]);

Route::get('addComment/{id}', [
    'as' => 'addComment',
    'uses' => 'PostController@addComment'
]);

Route::get('saveComment/{id}', [
    'as' => 'saveComment',
    'uses' => 'PostController@saveComment'
]);

Route::get('deletePost/{id}', [
    'as' => 'deletePost',
    'uses' => 'PostController@deletePost'
]);

Route::get('likeComment/{id}', [
    'as' => 'likeComment',
    'uses' => 'PostController@likeComment'
]);

Route::get('editComment/{id}', [
    'as' => 'editComment',
    'uses' => 'PostController@editComment'
]);
