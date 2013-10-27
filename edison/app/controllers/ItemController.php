<?php

class ItemController extends BaseController {

  public function showItem($screen_name, $id)
  {
    if (User::where('screen_name', '=', $screen_name)->first() == NULL) {
      return Redirect::to('/404');
    }
    if (Item::where('id', '=', $id)->first() == NULL) {
      return Redirect::to('/404');
    }
    
    $user = DB::table('users')->where('screen_name', '=', $screen_name)->get()[0];
    $item = DB::table('items')->where('id', '=', $id)->where('user_id', '=', $user->id)->get()[0];
    $tagmaps = DB::table('tagmaps')->where('item_id', $item->id)->get();
    $tags = array();
    foreach ($tagmaps as $tagmap) {
      $tags[] = DB::table('tags')->select('content')->where('id', $tagmap->tag_id)->get()[0]->content;
    }

    $comments = array();
    $cs = Comment::where('item_id', '=', $id)->get();
    foreach ($cs as $comment) {
      $comment_user = User::where('id', '=', $comment->user_id)->first();
      $comment['user'] = $comment_user;
      $comments[] = $comment;
    }

    $star_status = false;
    if (Auth::check()) {
      $auth_id = Auth::user()->id;
      $star_status = $this->getStarStatus($auth_id,$id);
    }

    $Niconico = new Niconico();
    $query = implode(' | ', $tags);
    $ret = $Niconico->sugoiSearch($item->type, $query);
    $related_works = array();
    if (isset($ret->values)) {
      foreach ($ret->values as $value) {
        $related_works[] = array(
          'cmsid' => $value->cmsid,
          'title' => $value->title,
          'thumbnail_url' => $value->thumbnail_url,
          'start_time' => $value->start_time,
          'view_counter' => $value->view_counter,
          'comment_counter' => $value->comment_counter,
          'mylist_counter' => $value->mylist_counter
        );
      }
    }

    $data = array(
      'item' => $item,
      'user' => $user,
      'works' => Work::where('item_id', '=', $item->id)->get(),
      'title' => $item->title,
      'comments' => $comments,
      'tags' => $tags,
      'star_status' => $star_status,
      'star_count' => Starmap::where('user_id', '=', $user->id)->count(),
      'work_count' => Work::where('user_id', '=', $user->id)->count(),
      'star_gazers_num' => Starmap::where('item_id', '=', $item->id)->count()[0],
      'related_works' => $related_works
    );

    return View::make('item', $data);
  }

  public function delete($screen_name, $item_id, $comment_id) {
    $item = Item::find($item_id);
    $comment = Comment::find($comment_id);

    if (Auth::user()->id === $comment->user_id && $item->id === $comment->item_id) {
      $item->delete();
      return Redirect::to("/$screen_name");
    } else {
      return Redirect::to("/$screen_name");      
    }
  }

  public function createComment($screen_name, $id) {
    $data = Input::all();

    $comment = new Comment;

    $comment->user_id = Auth::user()->id;
    $comment->item_id = $id;
    $comment->comment = $data['comment'];
    $comment->created_at = date("Y-m-d H:i:s");
    $comment->updated_at = date("Y-m-d H:i:s");

    $comment->save();

    return Redirect::to("/$screen_name/items/$id");
  }

  public function deleteComment($screen_name, $item_id, $comment_id) {
    $comment = Comment::find($comment_id);

    if (Auth::user()->id === $comment->user_id) {
      $comment->delete();
    } else {
      return Redirect::to("/$screen_name/item/$item_id");      
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
    $starmap = Starmap::where('user_id', '=', Auth::user()->id)->where('item_id', '=', $item_id)->first();
    if (Auth::user()->id === $starmap->user_id) {
      Starmap::destroy($starmap->id);
    }
  }

  public function stargazers($screen_name, $id) {
    if (User::where('screen_name', '=', $screen_name)->first() == NULL) {
      return Redirect::to('/404');
    }
    if (Item::where('id', '=', $id)->first() == NULL) {
      return Redirect::to('/404');
    }
    $stargazers = Starmap::where('item_id', '=', $id)->get();
    $users = array();
    foreach ($stargazers as $stargazer) {
      $users[] = User::where('id', '=', $stargazer->user_id)->get();
    }
    $data = array(
      'title' => 'スターゲイザー',
      'users' => $users
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
