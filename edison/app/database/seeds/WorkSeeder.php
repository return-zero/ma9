<?php

class WorkTableSeeder extends Seeder {

  public function run()
  {
    $urls = array(
      'sm21606267',
      'sm22108018',
      'sm22091259',
      'sm22105280',
      'sm22099716',
      'im3518715',
      'im3520973',
      'im3520124',
    );

    $now = date('Y-m-d H:i:s');
    
    $i=0;
    foreach($urls as $url) {
      Work::create(array(
        'item_id' => mt_rand(1, 8),
        'user_id' => mt_rand(1, 4),
        'title' => 'タイトル',
        'thumbnail_url' => 'http://tn-skr2.smilevideo.jp/smile?i=22130953',
        'url' => $url,
        'comment' => "$url の comment やで",
        'created_at' => $now,
        'updated_at' => $now,
      ));
    }
    
  }
}
