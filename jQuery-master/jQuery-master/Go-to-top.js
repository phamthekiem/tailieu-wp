// JavaScript Document
/*
HTML
<a href="javascript:;" id="gototop"><img src="<?php echo get_template_directory_uri();?>/images/icon_gototop.png" alt="lên đầu trang"></a>
CSS
#gototop {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    display: none;
}
*/
(function($) {
	$(document).ready(function() {
		/*Go to top*/
		$(".gototop").click(function(){
			$('html, body').animate({scrollTop:0}, 500 );
			return false;
		});
		$('#gototop').hide();
		$(window).scroll(function () {
		    if( $(this).scrollTop() > 300 ) {
			$('#gototop').fadeIn(300);
		    }
		    else {
			$('#gototop').fadeOut(300);
		    }
		});
	});
})(jQuery);
