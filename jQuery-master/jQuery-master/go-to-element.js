// JavaScript Document
(function($) {
	$(document).ready(function() {
		/*Go to element*/
		$("a.gotoDiv").click(function(){
			var idElement = $(this).attr("href");
			var top = $(idElement).offset().top;
			$('html, body').animate({scrollTop:top-44}, 500 );
			return false;
		});
	});
})(jQuery);