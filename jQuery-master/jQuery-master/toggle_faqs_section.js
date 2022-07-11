$('.open_desc').click(function(){
  var thisParents = $(this).parents('.list_history_sec3_box');
  if(thisParents.hasClass('active')){
    thisParents.find('.desc_history').slideUp('400',function(){
      thisParents.removeClass('active');
    });
  }else{
    thisParents.find('.desc_history').slideDown('400',function(){
      thisParents.addClass('active');
    });
  }
  return false;
});
