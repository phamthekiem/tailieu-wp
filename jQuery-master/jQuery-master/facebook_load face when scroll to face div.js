/**************************************************************
HTML to display
<div id="facebookHolder"></div>
**************************************************************/
/*AM22 Named Function to load FB box - START*/
$(document).ready(function(){
	var fb_loaded = false;
	var fb_div = $(".facebookHolder"); 
	function loadFaceBook()
	{
		var top = fb_div.offset().top;
		if ( !fb_loaded && ($(window).scrollTop() + window.innerHeight >= top ) )
		{
			fb_loaded = true;
		  
			fb_div.append('<div id="fb-root"></div>'); 
			fb_div.append('<div class="fb-like" data-href="http://levantoan.com" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>'); 
	 
		   	jQuery.getScript('http://connect.facebook.net/en_US/sdk.js#xfbml=1', function() { 
				FB.init({
					appId	: '',
					status	: true, 
					cookie	: true, 
					xfbml	: true,
					version	: 'v2.5'
				}); 
		   	}); 
		 } 
	}
	if (fb_div.size() > 0) { 
		$(window).scroll(loadFaceBook); 
	}
});