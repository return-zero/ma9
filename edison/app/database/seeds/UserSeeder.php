<?php

class CommentTableSeeder extends Seeder {

  public function run()
  {
    $screen_name = array(
      'morishita',
      'suwa',
      'super_waka',
      'fumichan',
    );

    $now = date('Y-m-d H:i:s');
    $id = 1;
    $oauth_token = "hogepiyo";
    $oauth_token_secret = "fugapoyo";
    
    foreach($screen_name as $s) {
      Comment::create(array(
        'id' => $id,
        'screen_name' => $s
        'oauth_token' => $oauth_token, 
        'oauth_token_secret' => $oauth_token_secret,
        'created_at' => $now,
        'updated_at' => $now,
      ));
      $id++;
    }
    
  }
}
