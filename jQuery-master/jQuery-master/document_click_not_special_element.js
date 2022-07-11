$(document).click(function(event) {
	if (!$(event.target).closest(".search_wrap_nav").length) {
    	$('.icon_search_click').removeClass('hiddenSearchButton');
  	$('.search_form_nav').removeClass('show_form');
    }
});
$(document).mouseup(function (e){
    var container = $(".bt-find, .header-search");
    if (!container.is(e.target) && container.has(e.target).length === 0){
        $('.header-search').hide();
    }
});
