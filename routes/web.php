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

//Route::get('/', function () {
//    return view('welcome');
//});





//Route::get('/', 'PagesController@main');

Route::get('/', 'PostsController@index');
Route::get('/admin', 'AdminController@index');
Route::get('/overview', 'PagesController@overview');
Route::get('/blogmain', 'PagesController@blog');
Route::get('/about', 'PagesController@about');


Route::resource('posts','PostsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('profile','HomeController');

Route::resource('comments','CommentsController');

Route::resource('admin','AdminController');

//resource routing for all exports
Route::get('excel','ExportController@export');
Route::get('pdf/{id}','ExportController@topdf');

// contact us route for email service

Route::resource('contactUs', 'ContactUsController');
