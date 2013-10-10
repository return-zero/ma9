<?php

class ItemController extends BaseController {

  public function showItem($screen_name, $id)
  {
    $user = DB::table('users')->where('screen_name', '=', $screen_name)->get();
    $data = DB::table('items')->where('id', '=', $id)->where('user_id', '=', $user[0]->id)->get();
    $tagmaps = DB::table('tagmaps')->where('item_id', $data[0]->id)->get();
    $tags = array();
    foreach ($tagmaps as $tagmap) {
      $tags[] = DB::table('tags')->select('content')->where('id', $tagmap->tag_id)->get()[0]->content;
    }
    $item = array(
      'title' => $data[0]->title,
      'content' => $data[0]->content,
      'created_at' => $data[0]->created_at,
      'updated_at' => $data[0]->updated_at,
      'tags' => $tags
    );
    return View::make('item', $item);
  }
}
