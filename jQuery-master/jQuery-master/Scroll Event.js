// JavaScript Document
$(document).ready(function(){	
	/**********
	 * Scroll
	 * **************/
	function scroll_element(){
		/*change color menu*/
		$top = $(window).scrollTop(); 
		if( $top >= 20 && !($('body').hasClass('menuStick')) ){
			$('body').addClass('menuStick');
		}else if($top < 20 && $('body').hasClass('menuStick') ){
			$('body').removeClass('menuStick');
		}
	}
	scroll_element();
	$(window).scroll(function(){
		scroll_element();
	});
	//mobile scroll
	$(window).bind('touchmove', function(e) {
		scroll_element();
	});
})