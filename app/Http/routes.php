<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', 'uses' => 'ArticleController@index']);
Route::get('/{page}', ['as' => 'index_page', 'uses' => 'ArticleController@index'])->where(['page' => '[0-9]+']);
Route::get('/article/category/{category}', ['as' => 'article_category', 'uses' => 'ArticleSearchController@showCategory']);
Route::get('/article/tag/{tag}', ['as' => 'article_tag', 'uses' => 'ArticleSearchController@showTag']);
Route::get('/admin', ['as' => 'admin', 'middleware' => 'auth', 'uses' => 'Admin\FeedController@index']);
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
