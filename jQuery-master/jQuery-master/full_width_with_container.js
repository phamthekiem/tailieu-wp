(function($){
	$(document).ready(function(){
		function og_full_width(){
		    $('.og-fullwidth').each(function () {
			var marginTop = $(this).css('margin-top');
			$(this).removeAttr('style');
			var windowWidth = $(window).width();
			var leftWidth = $(this).offset().left;
			var rightWidth = windowWidth - $(this).width() - $(this).offset().left;
			leftWidth = (leftWidth > 0)?leftWidth:0;
			rightWidth = (rightWidth > 0)?rightWidth:0;
			$(this).css({
			    "margin-left":-leftWidth+"px",
			    "margin-right":-rightWidth+"px",
			    "margin-top":marginTop,
			})
		    });
		}
		og_full_width();
		$(window).on('resize',function () {
		    og_full_width();
		});
	});
})(jQuery)
