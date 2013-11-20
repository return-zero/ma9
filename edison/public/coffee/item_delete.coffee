$("#js-delete-item").on "click", ->
  if window.confirm("この投稿を削除しますか？")
    $.ajax
      type: "post"
      url: location.href + "/delete"
      success: (data) ->
        location.href = "/"
