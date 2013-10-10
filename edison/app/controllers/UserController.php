<?php

class UserController extends BaseController {

  public function showUser($screen_name)
  {
    echo "<pre>";
    //var_dump(Auth::user());
    $user = User::where('screen_name', '=', $screen_name)->get();
    var_dump($user);
    echo "</pre>";
    
    $twitter_id = $user[0]->id;
    var_dump($twitter_id);
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

      //return View::make('other', $twitter_profile);

      //return View::make('user', $twitter_profile);

    }  catch(Exception $e) {
      echo $e->getMessage();
    }
    
    
    //$twitter_profile = User::getTwitterInfo($screen_name);
    //var_dump($twitter_profile);exit;
    if (Auth::user()->screen_name === $screen_name) {
      return View::make('me', $twitter_profile);
    } else {
      return View::make('other', $twitter_profile); 
    }
    return View::make('other', $twitter_profile);
  }

  public function showMypage()
  {
    echo "hogeeeeee";
  }


}
