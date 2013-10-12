<?php

class GroupCategoryTableSeeder extends Seeder {

  public function run()
  {
    //DB::table('categories')->delete();
    $group_categories = array(
      'g_ent2',
      'g_life2',
      'g_politics',
      'g_tech',
      'g_culture2',
      'g_other',
      'g_r18',
    );
    $now = date('Y-m-d H:i:s');
    
    foreach($group_categories as $group_category) {
      GroupCategory::create(array(
        'content' => $group_category,
        'created_at' => $now,
        'updated_at' => $now,
      ));
    }
    
  }
}
