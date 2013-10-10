<?php

use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password');


  public function getAuthIdentifier() {
    return $this->getKey();
  }

  public function getAuthPassword() {
    return null;
  }

  public static function getTwitterInfo($screen_name) {
    var_dump($table);exit;
    $user = $table->where('screen_name', '=', $screen_name)->get();
    var_dump($user);exit;
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

      return $twitter_profile;

    }  catch(Exception $e) {
      echo $e->getMessage();
    }

  }

}