<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BlogController@index');
Route::get('/post/{slug}', 'BlogController@showPost');
Route::get('/date/{date}', 'BlogController@showByDate');
Route::get('/user/{user_id}', 'BlogController@showByUser');
Route::get('/tag/{tag}', 'BlogController@showByTag');

Route::post('/postcomment', 'CommentController@create');

Route::get('/dashboard', 'AdminController@index');
Route::get('/dashboard/comments', 'AdminController@indexComments');
Route::get('/dashboard/comments/all', function () {
    $controller = new App\Http\Controllers\AdminController();

    return $controller->indexComments(true);
});
Route::get('/dashboard/comments/deleted', function () {
    $controller = new App\Http\Controllers\AdminController();

    return $controller->indexComments(false, true);
});
Route::get('/dashboard/comments/filter', 'AdminController@filterComments');

Route::delete('/dashboard/comments', 'AdminController@deleteComment');
Route::patch('/dashboard/comments', 'AdminController@ammendComment');
