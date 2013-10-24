<?php

class ApiController extends BaseController {

  public function getNoticeNum()
  {
    $login_user_id = Auth::user()->id;
    $notice_num = Starmap::where('user_id', '=', $login_user_id)->where('watched_flag', '=', 0)
                                                                ->where('notice_flag', '=', 1)
                                                                ->count();
    

    $json_val = array(
      'user_id' => $login_user_id,
      'screen_name' => Auth::user()->screen_name,
      'notice_num' => $notice_num,
    );

    header('Content-type: application/json');
    echo json_encode($json_val);
  }

  public function getCategories($type)
  {
    $categories = Category::where('type', '=', $type)->get();
    $ret = array();
    foreach ($categories as $category) {
      $ret['category'][] = array(
        'category_id' => $category->id,
        'content' => $category->content
      );
    }
    return json_encode($ret);
  }

  public function getNoticeContents()
  {
    $login_user_id = Auth::user()->id;
    $notice = Starmap::where('user_id', '=', $login_user_id)->where('watched_flag', '=', 0)
                                                            ->where('notice_flag', '=', 1)
                                                            ->get();
    $notice_item_ids = array();
    foreach ($notice as $n) {
      $notice_item_ids[] = $n["item_id"];
    }

    $notice_item_titles = array();
    foreach ($notice_item_ids as $notice_item_id) {
      $notice_item_titles[] = Item::where('id', '=', $notice_item_id)->get()[0]['title'];
    }

    $json_val = array("notice_title" => $notice_item_titles);

    header('Content-type: application/json');
    echo json_encode($json_val);
  }

  public function debug($val)
  {
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
    exit;
  }

  // public function watched()
  // {
  //   $login_user_id = Auth::user()->id;
  // }

}
