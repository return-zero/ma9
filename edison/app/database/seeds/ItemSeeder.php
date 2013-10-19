<?php

class ItemTableSeeder extends Seeder {

  public function run()
  {
    $title = array(
      'ピカチュウ',
      'カイリュウ',
      'ヤドラン',
      'ピジョン',
      'コダック',
      'コラッタ',
      'ズバット',
      'ギャロップ',
    );

    $now = date('Y-m-d H:i:s');
    $type = 'movie';
    
    foreach($title as $t) {
      Item::create(array(
        'category_id' => mt_rand(1, 29),
        'user_id' => mt_rand(1, 4),
        'title' => $t,
        'content' => "$t の content やで",
        'type' => $type,
        'created_at' => $now,
        'updated_at' => $now,
      ));
    }
    
  }
}
