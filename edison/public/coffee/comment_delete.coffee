$(".js-delete-comment").on "click", ->
 
  if window.confirm("このコメントを削除しますか？")
    comment_id = $(".js-delete-comment").data('comment-id')
    $.ajax
      type: "post"
      url: location.href + "/comment/" + comment_id + "/delete"
      success: (data) ->
    location.href = "/"
