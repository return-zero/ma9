<?php

class StarmapTableSeeder extends Seeder {

  public function run()
  { 
    $now = date('Y-m-d H:i:s');
    for($i = 0; $i < 8; $i++) {
      Starmap::create(array(
        'user_id' => mt_rand(1, 4),
        'item_id' => mt_rand(1, 8),
        'watched_flag' => 0,
        'created_at' => $now,
        'updated_at' => $now,
      ));
    }
    
  }
}
