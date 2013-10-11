<?php

class UserController extends BaseController {

  public function showUser($screen_name)
  {
    $user = DB::table('users')->where('screen_name', '=', $screen_name)->get();

    //if (isset($user[0])) {
    $twitter_id = $user[0]->id;

    try {
      Twitter::setOAuthToken($user[0]->oauth_token);
      Twitter::setOAuthTokenSecret($user[0]->oauth_token_secret);

      $timeline = Twitter::statusesUserTimeline($twitter_id);
      
      $twitter_profile = array(
        'screen_name' => $screen_name,
        'name' => $timeline[0]["user"]["name"],
        'desc' => $timeline[0]["user"]["description"]
        );

      if (Auth::user()->screen_name === $screen_name) {
        return View::make('me', $twitter_profile);
      } else {
        return View::make('other', $twitter_profile); 
      }

    }  catch(Exception $e) {
      echo $e->getMessage();
    }
    // }
  }

  public function getLogin()
  {
    if (Auth::check()) {
      return Redirect::to('/')->with('message', 'ログイン済みです。');
    }
    $tokens = Twitter::oAuthRequestToken();
    Twitter::oAuthAuthorize(array_get($tokens, 'oauth_token'));
    die;
  }

  public function getCallback()
  {
    $token = Input::get('oauth_token');
    $verifier = Input::get('oauth_verifier');
    $accessToken = Twitter::oAuthAccessToken($token, $verifier);
    
    if (isset($accessToken['user_id'])) {
      $user_id = $accessToken['user_id'];
      $user = User::find($user_id);
      if (empty($user)) {
        $user = new User;
        $user->id = $user_id;
      }
      $user->screen_name = $accessToken['screen_name'];
      $user->oauth_token = $accessToken['oauth_token'];
      $user->oauth_token_secret = $accessToken['oauth_token_secret'];
      $user->save();

      Auth::login($user);

      return Redirect::to('/');
    } else {
      return Redirect::to('login')->with('message', 'Twitter認証できませんでした。');
    }
  }

}
