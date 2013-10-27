category_names =
  ent: "エンターテイメント"
  music: "音楽"
  sing: "歌ってみた"
  play: "演奏してみた"
  dance: "踊ってみた"
  vocaloid: "VOCALOID"
  nicoindies: "ニコニコインディーズ"
  animal: "動物"
  cooking: "料理"
  nature: "自然"
  travel: "旅行"
  sport: "スポーツ"
  lecture: "ニコニコ動画講座"
  drive: "車載動画"
  history: "歴史"
  politics: "政治"
  science: "科学"
  tech: "ニコニコ技術部"
  handcraft: "ニコニコ手芸部"
  make: "作ってみた"
  anime: "アニメ"
  game: "ゲーム"
  toho: "東方"
  imas: "アイドルマスター"
  radio: "ラジオ"
  draw: "描いてみた"
  are: "例のアレ"
  diary: "日記"
  other: "その他"
  r18: "R-18"
  original: "オリジナル"
  portrait: "似顔絵"
  character: "キャラクター"
  r15: "R-15"
  gro: "R-15（グロテスク表現含む）"

$("input:radio").change ->
  $("select#category > option").remove()
  $.get "/api/getcategories/" + $(this).val(), (response) ->
    data = JSON.parse(response)
    i = 0

    while i < data.category.length
      $("select#category").append $("<option>").html(category_names[data.category[i].content]).val(data.category[i].category_id)
      i++
