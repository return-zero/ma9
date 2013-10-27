$(".js-delete-work").on "click", ->
 
  if window.confirm("削除するで？")
    work_id = $(".js-delete-work").data('work-id')

    $.ajax
      type: "post"
      url: "/work/delete/" + work_id
      success: (data) ->
      error: (data) ->
        console.log data
    #location.href = "/"