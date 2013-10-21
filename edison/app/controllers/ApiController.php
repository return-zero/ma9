<?php

class ApiController extends BaseController {

  public function getNoticeNum()
  {
    $login_user_id = Auth::user()->id;
    $not_watched_num = Starmap::where('user_id', '=', $login_user_id)->where('watched_flag', '=', 0)->count();

    $json_val = array(
      'user_id' => $login_user_id,
      'screen_name' => Auth::user()->screen_name,
      'notice_num' => $not_watched_num,
    );

    header('Content-type: application/json');
    echo json_encode($json_val);
  }

  // public function watched()
  // {
  //   $login_user_id = Auth::user()->id;
  // }

}
