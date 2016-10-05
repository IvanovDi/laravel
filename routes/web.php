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
    'uses' => 'CommentController@addComment'
]);

Route::get('saveComment/{id}', [
    'as' => 'saveComment',
    'uses' => 'CommentController@saveComment'
]);

Route::get('deletePost/{id}', [
    'as' => 'deletePost',
    'uses' => 'PostController@deletePost'
]);

Route::get('likeComment/{id}', [
    'as' => 'likeComment',
    'uses' => 'CommentController@likeComment'
]);

Route::get('editComment/{id}', [
    'as' => 'editComment',
    'uses' => 'CommentController@editComment'
]);

Route::get('profile', [
    'as' => 'profile',
    'uses' => 'ProfileController@profile'
]);

Route::get('editName', [
    'as' => 'editName',
    'uses' => 'ProfileController@editName'
]);

Route::get('editEmail', [
    'as' => 'editEmail',
    'uses' => 'ProfileController@editEmail'
]);

Route::get('editPassword', [
    'as' => 'editPassword',
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

Route::get('reship', [
    'as' => 'reship',
    'uses' => 'ActiveController@reship'
]);



