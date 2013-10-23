<?php

class ItemController extends BaseController {

  public function showItem($screen_name, $id)
  {
    $user = DB::table('users')->where('screen_name', '=', $screen_name)->get();
    $item = DB::table('items')->where('id', '=', $id)->where('user_id', '=', $user[0]->id)->get();
    $tagmaps = DB::table('tagmaps')->where('item_id', $item[0]->id)->get();
    $tags = array();
    foreach ($tagmaps as $tagmap) {
      $tags[] = DB::table('tags')->select('content')->where('id', $tagmap->tag_id)->get()[0]->content;
    }

    $comments = array();
    $cs = Comment::where('item_id', '=', $id)->get();
    foreach ($cs as $comment) {
      $name = User::where('id', '=', $comment->user_id)->first();
      $comment['name'] = $name;
      $comments[] = $comment;
    }

    $star_status = false;
    if (Auth::check()) {
      $auth_id = Auth::user()->id;
      $star_status = $this->getStarStatus($auth_id,$id);
    }

    $nico = new NicoSugoiSearch();
    $query = implode(' | ', $tags);
    $ret = $nico->search($item->type, $query);
    $related_works = array();
    if (isset($ret->values)) {
      foreach ($ret->values as $value) {
        $related_works[] = array(
          'cmsid' => $value->cmsid,
          'title' => $value->title,
          'thumbnail_url' => $value->thumbnail_url,
          'view_counter' => $value->view_counter,
          'comment_counter' => $value->comment_counter,
          'mylist_counter' => $value->mylist_counter
        );
      }
    }

    $data = array(
      'id' => $item[0]->id,
      'title' => $item[0]->title,
      'content' => $item[0]->content,
      'created_at' => $item[0]->created_at,
      'updated_at' => $item[0]->updated_at,
      'comments' => $comments,
      'tags' => $tags,
      'screen_name' => $screen_name,
      'star_status' => $star_status,
      'related_works' => $related_works
    );

    return View::make('item', $data);
  }

  public function delete($screen_name, $id) {
    $item = Item::find($id);

    if (Auth::user()->id == $item->user_id) {
      Item::destroy($id);
    } else {
      return Redirect::to("/");      
    }
  }

  public function createComment($screen_name, $id) {
    $data = Input::all();

    $user = User::where('screen_name', '=', $screen_name)->first();    

    $comment = new Comment;

    $comment->user_id = Auth::user()->id;
    $comment->item_id = $id;
    $comment->comment = $data['comment'];
    $comment->created_at = date("Y-m-d H:i:s");
    $comment->updated_at = date("Y-m-d H:i:s");

    $comment->save();

    return Redirect::to("/$screen_name/items/$id");
  }

  public function deleteComment($screen_name, $id) {
    $user = User::where('screen_name', '=', $screen_name)->first();
    $comment = Comment::find($id);

    if (Auth::user()->id === $comment->user_id) {
      Comment::destroy($id);
    } else {
      return Redirect::to("/$screen_name/item/$id");      
    }
  }

  public function getUserIdByScreenName($screen_name) {
    $user = User::where('screen_name', '=', $screen_name)->first();
    return $user->id;
  }

  /* ----------------------
     Star
  ---------------------- */

  public function star($screen_name, $id) {
    $now = date('Y-m-d H:i:s');

    DB::table('starmaps')->insert(
      array(
        'item_id' => $id,
        'user_id' => Auth::user()->id,
        'watched_flag' => 0,
        'created_at' => $now,
        'updated_at' => $now,
      )
    );
  }

  public function unstar($screen_name, $item_id) {
    $user_id = $this->getUserIdByScreenName($screen_name);
    $starmap = Starmap::where('user_id', '=', $user_id)->where('item_id', '=', $item_id)->first();
    if (Auth::user()->id === $starmap->user_id) {
      Starmap::destroy($starmap->id);
    }
  }

  public function stargazers($screen_name, $id) {
    $stargazers = Starmap::where('item_id', '=', 2)->get();
    $users = array();
    foreach ($stargazers as $stargazer) {
      $users[] = $stargazer->user_id;
    }
    $data = array(
      'title' => 'スターゲイザー',
      'ids' => $users
    );
    return View::make('stargazers', $data);
  }

  private function getStarStatus($auth_id, $item_id) {
    if(Starmap::where('user_id', '=', $auth_id)->where('item_id', '=', $item_id)->first() != NULL) { 
      return true;
    }
    return false;
  }


}
