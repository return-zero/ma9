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

    $notice_items_uesr = array();

    $notice_item_titles = array();
    foreach ($notice_item_ids as $notice_item_id) {
      $notice_items_uesr_ids[] = Item::where('id', '=', $notice_item_id)->get()[0]['user_id'];
      $notice_item_titles[] = Item::where('id', '=', $notice_item_id)->get()[0]['title'];
    }

    $notice_item_screen_name = array();
    foreach ($notice_items_uesr_ids as $user_id) {
      $notice_item_screen_name[] = User::where('id', '=', $user_id)->get()[0]['screen_name'];
    }

    $json_val = array("notice_title" => $notice_item_titles,
                      "notice_item_id" => $notice_item_ids,
                      "notice_item_user" => $notice_item_screen_name);

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
