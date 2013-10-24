<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'auth') ,function() {
	
	/* --------------
   HomeController
   -------------- */
  Route::get('new', 'HomeController@showNew');
  Route::post('new', 'HomeController@create');
	
	/* --------------
   ItemController
   -------------- */
  Route::post('{screen_name}/items/{id}/delete', 'ItemController@delete');
  Route::post('/{screen_name}/items/{id}/comment/new', 'ItemController@createComment');
  Route::post('/{screen_name}/items/{id}/comment/delete', 'ItemController@deleteComment');
  Route::post('{screen_name}/items/{id}/star', 'ItemController@star');
  Route::post('{screen_name}/items/{id}/unstar', 'ItemController@unstar');

  /* --------------
   WorkController
   -------------- */
  Route::get('work/new', 'WorkController@new');
  Route::post('work/create/{item_id}', 'WorkController@create');
  Route::post('work/delete/{item_id}', 'WorkController@delete');

});

/* --------------
   ApiController
   -------------- */
Route::get('api/get/notice/num', 'ApiController@getNoticeNum');
Route::get('api/getcategories/{type}', 'ApiController@getCategories');
Route::get('api/get/notice/contents', 'ApiController@getNoticeContents');

/* --------------
   HomeController
   -------------- */
Route::get('/', 'HomeController@showIndex');

/* --------------
   ItemController
   -------------- */
Route::get('{screen_name}/items/{id}', 'ItemController@showItem');
Route::get('{screen_name}/items/{id}/stargazers', 'ItemController@stargazers');

/* --------------
   UserController
   -------------- */
Route::get('login', 'UserController@getLogin');
Route::get('login/callback', 'UserController@getCallback');
Route::get('logout', 'UserController@getLogout');
Route::get('{screen_name}', 'UserController@showUser');
Route::get('{screen_name}/stars', 'UserController@showUserStars');

