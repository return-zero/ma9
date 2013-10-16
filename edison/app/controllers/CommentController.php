<?php

class CommentController extends BaseController {

  public function create() {
    $data = Input::all();
    var_dump($data);

    $comment = new Comment;
    
    $comment->user_id = {screen_name};
    $comment->item_id = {id};
    
  }

}
