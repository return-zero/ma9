<?php

class CommentTableSeeder extends Seeder {

  public function run()
  {
    $comment = array(
      'コメントやで',
      'コメントだよ',
      'コメントでおま',
      'コマントなのです！',
      'コメント5',
      'コメント6',
      'コメントやで',
      'コメントだよ4',
      'コメントでおま4',
      'コマントなのです！2',
      'コメントだよ2',
    );

    $now = date('Y-m-d H:i:s');
    
    foreach($comment as $c) {
      Comment::create(array(
        'user_id' => mt_rand(1, 4),
        'item_id' => mt_rand(1, 8),
        'comment' => $c,
        'created_at' => $now,
        'updated_at' => $now,
      ));
    }
    
  }
}
