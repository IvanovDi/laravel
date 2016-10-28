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

Auth::routes();

Route::group(['middleware' => ['auth', 'active.user']], function()
{

Route::get('/', 'HomeController@index');

Route::resource('post', 'PostController', [
    'except' => [
        'index', 'edit', 'update'
    ]
]);

Route::get('saveComment/{id}', [
    'as' => 'comment.save',
    'uses' => 'CommentController@saveComment'
]);

Route::get('likeComment/{id}', [
    'as' => 'comment.like',
    'uses' => 'CommentController@likeComment'
]);

Route::get('editComment/{id}', [
    'as' => 'comment.edit',
    'uses' => 'CommentController@editComment'
]);

Route::get('profile', [
    'as' => 'profile',
    'uses' => 'ProfileController@profile'
]);

Route::post('editName', [
    'as' => 'profile.editName',
    'uses' => 'ProfileController@editName'
]);

Route::post('editEmail', [
    'as' => 'profile.editEmail',
    'uses' => 'ProfileController@editEmail'
]);

Route::post('editPassword', [
    'as' => 'profile.editPassword',
    'uses' => 'ProfileController@editPassword'
]);

});

Route::get('comparison' ,[
    'as' => 'comparison',
    'uses' => 'ActiveController@activate']);

Route::get('noactive', [
    'as' => 'noactive',
    'uses' => 'ActiveController@noactive'
]);

Route::post('reship', [
    'as' => 'reship',
    'uses' => 'ActiveController@reship'
]);

