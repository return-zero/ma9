$("#js-delete-item").on "click", ->
  if window.confirm("削除するで？")
    $.ajax
      type: "post"
      url: location.href + "/delete"
      success: (data) ->
    location.href = "/"
