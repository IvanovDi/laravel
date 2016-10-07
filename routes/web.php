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

Route::group(['middleware' => ['auth', 'active.user']], function()
{

Route::get('/', 'HomeController@index');

Route::get('create', [
    'as' => 'post.create',
    'uses' => 'PostController@create'
]);

Route::post('save', [
    'as' => 'post.save',
    'uses' => 'PostController@save'
]);

Route::get('showPost/{id}', [
    'as' => 'post.show',
    'uses' => 'PostController@showPost'
]);

Route::get('saveComment/{id}', [
    'as' => 'comment.save',
    'uses' => 'CommentController@saveComment'
]);

Route::get('deletePost/{id}', [
    'as' => 'post.delete',
    'uses' => 'PostController@deletePost'
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

Route::post('noactive', [
    'as' => 'noactive',
    'uses' => 'ActiveController@noactive'
]);

Route::post('reship', [
    'as' => 'reship',
    'uses' => 'ActiveController@reship'
]);



