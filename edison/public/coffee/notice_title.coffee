url = "http://192.168.33.10/api/get/notice/contents"
$.get url, (res) ->
  notice = JSON.parse(res)
  i = 0

  while i < notice.notice_title.length
    $(".notice-content").append "<a href=\"/" + notice.notice_item_user[i] + "/items/" + notice.notice_item_id[i] + "\">" + notice.notice_title[i] + "</a>"
    i++