$("#star").click ->
  if $("#star").hasClass("btn-default")
    return $.ajax(
      type: "post"
      url: location.href + "/star"
      success: (data) ->
        $("#star").removeClass "btn-default"
        $("#star").addClass "btn-warning"
    )
  if $("#star").hasClass("btn-warning")
    $.ajax
      type: "post"
      url: location.href + "/unstar"
      success: (data) ->
        $("#star").removeClass "btn-warning"
        $("#star").addClass "btn-default"
