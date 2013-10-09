<?php

class ItemController extends BaseController {

  public function showItem($id)
  {
    $data = DB::table('items')->where('id', '=', $id)->get();
    $item = array(
      'title' => $data[0]->title,
      'content' => $data[0]->content,
      'created_at' => $data[0]->created_at,
      'updated_at' => $data[0]->updated_at
    );
    return View::make('item', $item);
  }
}
