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
//**All About posts
Route::post('search', 'PostsController@search');
Route::get('posts-by-category/{slug}', 'PostsController@getPostsByCategorySlug');
Route::get('post/{id}', 'PostsController@single');
Route::get('post-by-slug/{slug}', 'PostsController@getPostBySlug');
Route::get('categories', 'CategoriesController@list');
Route::get('popular-posts/{category?}', 'PostsController@popularPosts');
Route::get('popular-posts', 'PostsController@popularPosts');
Route::get('/all-categories', 'CategoriesController@allCategrories');
Route::get('category/{id?}', 'CategoriesController@getCategory');
Route::put('category/{id}', 'CategoriesController@editCategory')->middleware('auth:sanctum');
Route::delete('category/{id}', 'CategoriesController@delete')->middleware('auth:sanctum');
Route::post('category', 'CategoriesController@store')->middleware('auth:sanctum');
Route::delete('post/{id}', 'PostsController@delete')->middleware('auth:sanctum');
Route::post('post/{id}/edit', 'PostsController@update')->middleware('auth:sanctum');
Route::post('upload-image', 'PostsController@uploadImage')->middleware('auth:sanctum');

//**About users
Route::get('all-roles', 'RolesController@getRoles')->middleware('auth:sanctum');

Route::namespace('Users')->group(function(){
    Route::get('auth-user', 'UsersController@getAuthUser')->middleware('auth:sanctum');
    Route::get('user-by-username/{username}', 'UsersController@getUserByUsername');
    Route::post('user-by-username', 'UsersController@getUserByUsername');
    Route::get('user-by-email/{email}', 'UsersController@getUserByEmail');
    Route::post('user-by-email', 'UsersController@getUserByEmail');
    Route::post('add-user', 'UsersController@addUser')->middleware('auth:sanctum');
    Route::put('edit-user/{id}', 'UsersController@addUser')->middleware('auth:sanctum');
    Route::get('users-list', 'UsersController@allUsers')->middleware('auth:sanctum');
    Route::get('/user/{id}', 'UsersController@getUserById')->middleware('auth:sanctum');
    Route::put('/user/{id}', 'UsersController@update')->middleware('auth:sanctum');
    Route::delete('/user/{id}', 'UsersController@delete')->middleware('auth:sanctum');
});
