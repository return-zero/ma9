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
  Route::get('new', 'HomeController@showNew');
  Route::post('new', 'HomeController@create');
  //Route::get('{screen_name}', 'UserController@showUser');

});

Route::get('/', 'HomeController@showIndex');
Route::get('{screen_name}/items/{id}', 'ItemController@showItem');
//Route::get('{screen_name}', 'UserController@showUser');

Route::get('login', 'UserController@getLogin');

// Route::get('login', function() {
// 	if (Auth::check()) {
// 		return Redirect::to('/')->with('message', 'ログイン済みです。');
// 	}
// 	$tokens = Twitter::oAuthRequestToken();
// 	Twitter::oAuthAuthorize(array_get($tokens, 'oauth_token'));
// 	die;
// });

Route::get('login/callback', 'UserController@getCallback');

// Route::get('login/callback', function() {
// 	$token = Input::get('oauth_token');
// 	$verifier = Input::get('oauth_verifier');
// 	$accessToken = Twitter::oAuthAccessToken($token, $verifier);
	
// 	if (isset($accessToken['user_id'])) {
// 		$user_id = $accessToken['user_id'];
// 		$user = User::find($user_id);
// 		if (empty($user)) {
// 			$user = new User;
// 			$user->id = $user_id;
// 		}
// 		$user->screen_name = $accessToken['screen_name'];
// 		$user->oauth_token = $accessToken['oauth_token'];
// 		$user->oauth_token_secret = $accessToken['oauth_token_secret'];
// 		$user->save();

// 		Auth::login($user);

// 		return Redirect::to('/');
// 	} else {
// 		return Redirect::to('login')->with('message', 'Twitter認証できませんでした。');
// 	}
// });


Route::get('logout', function() {
   Auth::logout();
   return Redirect::to('/')->with('message', 'ログアウトしました。');
});

Route::get('{screen_name}', 'UserController@showUser');



Route::filter('auth', function() {
  if (!Auth::check()) return Redirect::to('/');
});
