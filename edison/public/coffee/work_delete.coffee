$(".js-delete-work").on "click", ->
 
  if window.confirm("削除するで？")
    work_id = $(".js-delete-work").data('work-id')
    $.ajax
      type: "post"
      url: location.href + "/work/" + work_id + "/delete"
      success: (data) ->
    location.href = "/"