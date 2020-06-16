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
Route::get('post-by-slug/{slug}', 'PostsController@getPostBySlug');
Route::get('categories', 'CategoriesController@list');
Route::get('/all-categories', 'CategoriesController@allCategrories');
Route::get('category/{id?}', 'CategoriesController@getCategory');
Route::put('category/{id}', 'CategoriesController@editCategory')->middleware('auth:sanctum');
Route::delete('category/{id}', 'CategoriesController@delete')->middleware('auth:sanctum');
Route::post('category', 'CategoriesController@store')->middleware('auth:sanctum');
Route::delete('post/{id}', 'PostsController@delete')->middleware('auth:sanctum');
Route::post('post/{id}/edit', 'PostsController@update')->middleware('auth:sanctum');
Route::post('upload-image', 'PostsController@uploadImage')->middleware('auth:sanctum');
