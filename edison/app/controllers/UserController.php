<?php

class UserController extends BaseController {

  public function showUser($screen_name)
  {
    $user = User::where('screen_name', '=', $screen_name)->first();

    $twitter_id = $user->id;

    try {
      Twitter::setOAuthToken($user->oauth_token);
      Twitter::setOAuthTokenSecret($user->oauth_token_secret);

      $timeline = Twitter::statusesUserTimeline($twitter_id);
      
      $items = $this->showUserItems($screen_name);
            
      $twitter_profile = array(
        'screen_name' => $screen_name,
        'name' => $timeline[0]["user"]["name"],
        'desc' => $timeline[0]["user"]["description"],
        'icon' => $timeline[0]["user"]["profile_image_url"],
        'items' => $items
      );

      return View::make('user', $twitter_profile); 
      

    }  catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  
  public function showUserItems($screen_name)
  {
    $user = User::where('screen_name','=',$screen_name)->first();
    $items = Item::where('user_id','=',$user->id)->get();
    $results = array();
    foreach ($items as $item) {
      $results[] = array(
      	'item_id' => $item->id,
        'title' => $item->title,
        'content' => $item->content,
        'created_at' => $item->created_at,
        'updated_at' => $item->updated_at
      );
    }
    return $results;
  }

  public function showUserStars($screen_name)
  {
    $user = User::where('screen_name','=',$screen_name)->first();
    $star_items_id = array();
    $fav_lists = Favmap::where('user_id', '=', $user->id)->get();
    foreach($fav_lists as $fav_list) {
      $star_items_id[] = $fav_list->item_id; 
    }

    $star_items = array();
    foreach($star_items_id as $star_item_id) {
      $item = Item::where('id', '=', $star_item_id)->first();
      $star_items[] = $item;
    }
    
    return View::make('stars', $star_items);
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

  public function getLogout()
  {
    Auth::logout();
    return Redirect::to('/')->with('message', 'ログアウトしました。');
  }

}
