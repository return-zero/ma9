$(function() {
  $('#tag-plus').click(function() {
    var div = $('<div>').addClass('input-group');
    div.append('<input class="form-control" name="tags[]">','<span class="input-group-addon btn tag-minus">×</span>');
    $(this).before(div);
  });
  $('#tag-form-wrap').on('click','.tag-minus',function(){
    $(this).parent().remove();
  });
});