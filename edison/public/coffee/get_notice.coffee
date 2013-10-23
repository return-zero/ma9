url = "http://192.168.33.10/api/get/notice/num"
$.get url, (res) ->
  notice_num = JSON.parse(res).notice_num
  $("#js-notice a").text notice_num