<?php

class UserController extends BaseController {

  public function showUser($screen_name)
  {
    $user = DB::table('users')->where('screen_name', '=', $screen_name)->get();
    $twitter_id = $user[0]->id;


    try{
      Twitter::setOAuthToken($user[0]->oauth_token);
      Twitter::setOAuthTokenSecret($user[0]->oauth_token_secret);

      $timeline = Twitter::statusesUserTimeline($twitter_id);
      
      $twitter_profile = array(
        'screen_name' => $screen_name,
        'name' => $timeline[0]["user"]["name"],
        'desc' => $timeline[0]["user"]["description"]
      );

      return View::make('user', $twitter_profile);

    }  catch(Exception $e) {
      echo $e->getMessage();
    }
  }
}
