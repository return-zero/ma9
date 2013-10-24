url = "http://192.168.33.10/api/get/notice/num"
$.get url, (res) ->
  notice_num = JSON.parse(res).notice_num
  $("#js-notice a").text notice_num

get_url = "http://192.168.33.10/api/get/notice/contents"
$.get get_url, (res) ->
  notice = JSON.parse(res)
  i = 0

  while i < notice.notice_title.length
    $(".notice-content").append "<a class=\"notice-item\" href=\"/" + notice.notice_item_user[i] + "/items/" + notice.notice_item_id[i] + "\">" + notice.notice_title[i] + "</a>"
    i++
  $(".notice-content a").click ->
    item_data = $(this).attr("href").split("/")
    item_id = item_data[item_data.length - 1]
    screen_name = item_data[item_data.length - 3]
    post_url = "http://192.168.33.10/api/post/watched"
    $.ajax
      type: "post"
      url: post_url
      data:
        item_id: item_id
        screen_name: screen_name

      success: (data) ->
        alert data