$(".js-delete-comment").on "click", ->
 
  if window.confirm("このコメントを削除しますか？")
    comment_id = $(this).data('comment-id')
    $.ajax
      type: "post"
      url: location.href + "/comment/" + comment_id + "/delete"
      success: (data) ->
        location.href = location.href
