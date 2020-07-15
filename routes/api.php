<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//List all comments
//Route::apiResource('comment','CommentsController');

//List all posts
Route::get('apiposts','PostApiController@index');

//List single post
Route::get('apipost/{id}','PostApiController@show');

//Create new article
Route::post('apipost','PostApiController@store');

//Update article
Route::put('apipost','PostApiController@store');

//Delete article
Route::delete('apipost/{id}','PostApiController@destroy');






