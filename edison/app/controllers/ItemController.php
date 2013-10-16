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

    $cs = Comment::where('item_id', '=', $id)->get();
    foreach ($cs as $comment) {
      $name = User::where('id', '=', $comment->user_id)->first();
      $comment['name'] = $name;
      $comments[] = $comment;
    }

    $item = array(
      'id' => $data[0]->id,
      'title' => $data[0]->title,
      'content' => $data[0]->content,
      'created_at' => $data[0]->created_at,
      'updated_at' => $data[0]->updated_at,
      'comments' => $comments,
      'tags' => $tags,
      'screen_name' => $screen_name,
    );
    return View::make('item', $item);
  }

  public function delete($screen_name, $id) {
    $user = User::where('screen_name', '=', $screen_name)->first();
    $item = Item::find($id);

    if ($user->id == $item->user_id) {
      Item::destroy($id);
    } else {
      return Redirect::to('/');      
    }
  }

  public function createComment($screen_name, $id) {
    $data = Input::all();

    $user = User::where('screen_name', '=', $screen_name)->first();    

    $comment = new Comment;
    
    $comment->user_id = $user->id;
    $comment->item_id = $id;
    $comment->comment = $data['comment'];
    $comment->created_at = date("Y-m-d H:i:s");
    $comment->updated_at = date("Y-m-d H:i:s");

    $comment->save();

    return Redirect::to('/');
  }

  public function deleteComment($screen_name, $id) {
    $user = User::where('screen_name', '=', $screen_name)->first();
    $comment = Comment::find($id);

    if ($user->id == $comment->user_id) {
      Comment::destroy($id);
    } else {
      return Redirect::to('/');      
    }
  }

  public function favorite($screen_name, $id) {
    DB::table('favmaps')->insert(
      array(
        'item_id' => $id,
        'user_id' => Auth::user()->id,
        'watched_flag' => 0
      )
    );
  }

  public function stargazers($screen_name, $id) {
    $stargazers = Favmap::where('item_id', '=', 2)->get();
    $users = array();
    foreach ($stargazers as $stargazer) {
      $users['ids'][] = $stargazer->user_id;
    }
    return View::make('stargazers', $users);
  }
}
