<?php

class ApiController extends BaseController {

  public function getNoticeNum()
  {
    $login_user_id = Auth::user()->id;
    $notice_num = Starmap::where('user_id', '=', $login_user_id)
                         ->where('watched_flag', '=', 0)
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
    $notice = Starmap::where('user_id', '=', $login_user_id)
                     ->where('watched_flag', '=', 0)
                     ->where('notice_flag', '=', 1)
                     ->get();

    $notice_item_ids = array();
    foreach ($notice as $n) {
      $notice_item_ids[] = $n["item_id"];
    }

    $notice_items_uesr = array();
    $notice_item_titles = array();
    $notice_work_ids = array();
    foreach ($notice_item_ids as $notice_item_id) {
      $notice_items_uesr_ids[] = Item::where('id', '=', $notice_item_id)->get()[0]['user_id'];
      $notice_item_titles[] = Item::where('id', '=', $notice_item_id)->get()[0]['title'];
      $notice_work_ids[] = Work::where('item_id', '=', $notice_item_id)->orderBy('created_at', 'desc')->get()[0]['item_id'];
    }
    //$this->debug($notice_work_ids);

    $notice_work_user_ids = array();
    $notice_work_title = array();
    foreach ($notice_work_ids as $notice_work_id) {
      var_dump($notice_work_id);
      $notice_work_user_ids[] = Work::where('id', '=', $notice_work_id)->orderBy('updated_at', 'asc')->get()[0]['user_id'];
      $notice_work_title[] = Work::where('id', '=', $notice_work_id)->orderBy('id', 'asc')->get()[0]['title'];
    }
    $this->debug($notice_work_user_ids);
    //$this->debug($notice_work_title);
// ---------

    $notice_work_user_screen_name = array();
    foreach ($notice_work_user_ids as $notice_work_user_id) {
      $notice_work_user_screen_name = User::where('id', '=', $notice_work_user_id)->get()[0]['screen_name'];
    }
    //$this->debug($notice_work_user_screen_name);


    $notice_item_screen_name = array();
    foreach ($notice_items_uesr_ids as $user_id) {
      $notice_item_screen_name[] = User::where('id', '=', $user_id)->get()[0]['screen_name'];
    }



    $json_val = array("notice_title" => $notice_item_titles,
                      "notice_item_id" => $notice_item_ids,
                      "notice_item_user" => $notice_item_screen_name,
                      "notice_work_title" => $notice_work_title,
                      "notice_work_user" => $notice_work_user_screen_name);

    header('Content-type: application/json');
    echo json_encode($json_val);
  }


  public static function debug($val)
  {
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
    exit;
  }


  public function postWatched()
  {
    $login_user_id = Auth::user()->id;
    Starmap::where('user_id', '=', $login_user_id)
           ->where('item_id', '=', $_POST['item_id'])
           ->update(array('watched_flag' => 1));
  }

}
