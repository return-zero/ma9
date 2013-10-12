<?php

class CategoryTableSeeder extends Seeder {

  public function run()
  {
    //DB::table('categories')->delete();
    $categories = array(
      array( 'group_category_id' => 1, 'name' => 'ent'),
      array( 'group_category_id' => 1, 'name' => 'music'),
      array( 'group_category_id' => 1, 'name' => 'sing'),
      array( 'group_category_id' => 1, 'name' => 'play'),
      array( 'group_category_id' => 1, 'name' => 'dance'),
      array( 'group_category_id' => 1, 'name' => 'vocaloid'),
      array( 'group_category_id' => 1, 'name' => 'nicoindies'),
      array( 'group_category_id' => 2, 'name' => 'animal'),
      array( 'group_category_id' => 2, 'name' => 'cooking'),
      array( 'group_category_id' => 2, 'name' => 'nature'),
      array( 'group_category_id' => 2, 'name' => 'travel'),
      array( 'group_category_id' => 2, 'name' => 'sport'),
      array( 'group_category_id' => 2, 'name' => 'lecture'),
      array( 'group_category_id' => 2, 'name' => 'drive'),
      array( 'group_category_id' => 2, 'name' => 'history'),
      array( 'group_category_id' => 3, 'name' => 'g_politics'),
      array( 'group_category_id' => 4, 'name' => 'science'),
      array( 'group_category_id' => 4, 'name' => 'tech'),
      array( 'group_category_id' => 4, 'name' => 'handcraft'),
      array( 'group_category_id' => 4, 'name' => 'make'),
      array( 'group_category_id' => 5, 'name' => 'anime'),
      array( 'group_category_id' => 5, 'name' => 'game'),
      array( 'group_category_id' => 5, 'name' => 'toho'),
      array( 'group_category_id' => 5, 'name' => 'imas'),
      array( 'group_category_id' => 5, 'name' => 'radio'),
      array( 'group_category_id' => 5, 'name' => 'draw'),
      array( 'group_category_id' => 6, 'name' => 'are'),
      array( 'group_category_id' => 6, 'name' => 'diary'),
      array( 'group_category_id' => 6, 'name' => 'other'),
      array( 'group_category_id' => 7, 'name' => 'g_r18'),
    );
    $now = date('Y-m-d H:i:s');
    
    foreach($categories as $category) {
      Category::create(array(
        'group_category_id' => $category['group_category_id'],
        'content' => $category['name'],
        'created_at' => $now,
        'updated_at' => $now,
      ));
    }
    
  }
}