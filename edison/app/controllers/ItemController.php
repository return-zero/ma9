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
    if ($item->type == 'video') {
      $pattern = '/^http:\/\/www\.nicovideo\.jp\/watch\/(sm[0-9]+)/';
    } else {
      $pattern= '/^http:\/\/seiga\.nicovideo\.jp\/seiga\/(im[0-9]+)/';
    }

    $data = array(
      'item' => $item,
      'user' => $user,
      'works' => Work::where('item_id', '=', $item->id)->get(),
      'pattern' => $pattern,
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

  public function showNew()
  {
    $categories = Category::where('type', '=', 'video')->get();
    $category_names = array(
      'ent' => 'エンターテイメント',
      'music' => '音楽',
      'sing' => '歌ってみた',
      'play' => '演奏してみた',
      'dance' => '踊ってみた',
      'vocaloid' => 'VOCALOID',
      'nicoindies' => 'ニコニコインディーズ',
      'animal' => '動物',
      'cooking' => '料理',
      'nature' => '自然',
      'travel' => '旅行',
      'sport' => 'スポーツ',
      'lecture' => 'ニコニコ動画講座',
      'drive' => '車載動画',
      'history' => '歴史',
      'politics' => '政治',
      'science' => '科学',
      'tech' => 'ニコニコ技術部',
      'handcraft' => 'ニコニコ手芸部',
      'make' => '作ってみた',
      'anime' => 'アニメ',
      'game' => 'toho',
      'toho' => '東方',
      'imas' => 'アイドルマスター',
      'radio' => 'ラジオ',
      'draw' => '描いてみた',
      'are' => '例のアレ',
      'diary' => '日記',
      'other' => 'その他',
      'r18' => 'R-18',
    );
    $data = array(
      'title' => '新規投稿',
      'categories' => $categories,
      'names' => $category_names
    );
    return View::make('new', $data);
  }


  public function create()
  {
    $data = Input::all();
    $item_id = DB::table('items')->insertGetId(
      array(
        'category_id' => $data['category_id'],
        'user_id' => Auth::user()->id,
        'title' => $data['title'],
        'content' => $data['content'],
        'type' => $data['type'],
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      )
    );
    foreach ($data['tags'] as $tag) {
      if ($tag == '') {
        continue;
      }
      $result = DB::table('tags')->where('content', $tag)->get();
      if (empty($result)) {
        $tag_id = DB::table('tags')->insertGetId(
          array(
            'content' => $tag
          )
        );
        DB::table('tagmaps')->insert(
          array(
            'item_id' =>  $item_id,
            'tag_id' => $tag_id
          )
        );
      } else {
        DB::table('tagmaps')->insert(
          array(
            'item_id' =>  $item_id,
            'tag_id' => $result[0]->id
          )
        );
      }
    }
  }

  public function delete($screen_name, $item_id) {
    $item = Item::find($item_id);
    
    if (Auth::user()->id === $item->user_id) {
      $item->delete();
      Work::where('item_id', '=', $item_id)->delete();
      Comment::where('item_id', '=', $item_id)->delete();
      return Redirect::to("/$screen_name");
      exit;
    } else {
      return Redirect::to("/$screen_name");      
    }
  }

  public function createComment($screen_name, $item_id) {
    $data = Input::all();

    $comment = new Comment;

    $comment->user_id = Auth::user()->id;
    $comment->item_id = $item_id;
    $comment->comment = $data['comment'];
    $comment->created_at = date("Y-m-d H:i:s");
    $comment->updated_at = date("Y-m-d H:i:s");

    $comment->save();

    return Redirect::to("/$screen_name/items/$item_id");
  }

  public function deleteComment($screen_name, $item_id, $comment_id) {
    $comment = Comment::find($comment_id);
    $item = Item::find($item_id);

    if (Auth::user()->id === $comment->user_id && $item->id === $comment->item_id) {
      $comment->delete();
      return Redirect::to("/$screen_name/items/$item_id");
    } else {
      return Redirect::to("/$screen_name/items/$item_id");
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
