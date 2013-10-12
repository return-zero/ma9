<?php

class CommentController extends BaseController {

  public function create() {
    $data = Input::all();
    var_dump($data);
  }

}
