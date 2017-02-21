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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
