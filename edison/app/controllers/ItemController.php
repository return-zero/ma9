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

    $comments = Comment::where('item_id', '=', $id)->get();

    $item = array(
      'id' => $id,
      'title' => $data[0]->title,
      'content' => $data[0]->content,
      'created_at' => $data[0]->created_at,
      'updated_at' => $data[0]->updated_at,
      'comments' => $comments,
      'tags' => $tags
    );
    return View::make('item', $item);
  }

  public function delete($name,$id) {
    $user = User::where('screen_name', '=', $name)->first();
    $item = Item::find($id);

    if ($user->id == $item->user_id) {
      Item::destroy($id);
    } else {
      return Redirect::to('/');      
    }
  }

  public function createComment($id) {
    $data = Input::all();

    $comment = new Comment;
    
    $comment->user_id = 111;
    $comment->item_id = $id;
    $comment->comment = $data['comment'];
    $comment->created_at = date("Y-m-d H:i:s");
    $comment->updated_at = date("Y-m-d H:i:s");

    $comment->save();

    return Redirect::to('/');
  }
}
