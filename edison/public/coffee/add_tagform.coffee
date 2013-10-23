$ ->
  $("#tag-plus").click ->
    div = $("<div>").addClass("input-group")
    div.append "<input class=\"form-control\" name=\"tags[]\">", "<span class=\"input-group-addon btn tag-minus\">×</span>"
    $(this).before div
  $("#tag-form-wrap").on "click", ".tag-minus", ->
    $(this).parent().remove()