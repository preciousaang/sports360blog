<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Users\LoginController@login')->middleware('guest:sanctum');
Route::post('logout', 'Users\LoginController@logout');
Route::post('add-post', 'PostsController@store')->middleware('auth:sanctum');
Route::get('posts', 'PostsController@list');
Route::get('all-posts/{opt?}', 'PostsController@allPosts');
Route::get('post/{id}', 'PostsController@single');
Route::delete('post/{id}', 'PostsController@delete')->middleware('auth:sanctum');
Route::post('post/{id}/edit', 'PostsController@update')->middleware('auth:sanctum');
