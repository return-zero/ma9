<?php

class CategoryTableSeeder extends Seeder {

  public function run()
  {
    //DB::table('categories')->delete();
    $categories = array(
      array( 'type' => 'video', 'group_category_id' => 1, 'name' => 'ent'),
      array( 'type' => 'video', 'group_category_id' => 1, 'name' => 'music'),
      array( 'type' => 'video', 'group_category_id' => 1, 'name' => 'sing'),
      array( 'type' => 'video', 'group_category_id' => 1, 'name' => 'play'),
      array( 'type' => 'video', 'group_category_id' => 1, 'name' => 'dance'),
      array( 'type' => 'video', 'group_category_id' => 1, 'name' => 'vocaloid'),
      array( 'type' => 'video', 'group_category_id' => 1, 'name' => 'nicoindies'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'animal'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'cooking'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'nature'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'travel'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'sport'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'lecture'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'drive'),
      array( 'type' => 'video', 'group_category_id' => 2, 'name' => 'history'),
      array( 'type' => 'video', 'group_category_id' => 3, 'name' => 'politics'),
      array( 'type' => 'video', 'group_category_id' => 4, 'name' => 'science'),
      array( 'type' => 'video', 'group_category_id' => 4, 'name' => 'tech'),
      array( 'type' => 'video', 'group_category_id' => 4, 'name' => 'handcraft'),
      array( 'type' => 'video', 'group_category_id' => 4, 'name' => 'make'),
      array( 'type' => 'video', 'group_category_id' => 5, 'name' => 'anime'),
      array( 'type' => 'video', 'group_category_id' => 5, 'name' => 'game'),
      array( 'type' => 'video', 'group_category_id' => 5, 'name' => 'toho'),
      array( 'type' => 'video', 'group_category_id' => 5, 'name' => 'imas'),
      array( 'type' => 'video', 'group_category_id' => 5, 'name' => 'radio'),
      array( 'type' => 'video', 'group_category_id' => 5, 'name' => 'draw'),
      array( 'type' => 'video', 'group_category_id' => 6, 'name' => 'are'),
      array( 'type' => 'video', 'group_category_id' => 6, 'name' => 'diary'),
      array( 'type' => 'video', 'group_category_id' => 6, 'name' => 'other'),
      array( 'type' => 'video', 'group_category_id' => 7, 'name' => 'r18'),
      array( 'type' => 'illust', 'group_category_id' => 8, 'name' => 'original'),
      array( 'type' => 'illust', 'group_category_id' => 8, 'name' => 'portrait'),
      array( 'type' => 'illust', 'group_category_id' => 9, 'name' => 'anime'),
      array( 'type' => 'illust', 'group_category_id' => 9, 'name' => 'game'),
      array( 'type' => 'illust', 'group_category_id' => 9, 'name' => 'character'),
      array( 'type' => 'illust', 'group_category_id' => 10, 'name' => 'toho'),
      array( 'type' => 'illust', 'group_category_id' => 10, 'name' => 'vocaloid'),
    );
    
    foreach($categories as $category) {
      Category::create(array(
        'group_category_id' => $category['group_category_id'],
        'content' => $category['name']
      ));
    }
    
  }
}
