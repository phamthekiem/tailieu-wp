var loading = false;
$(window).scroll(function(){
	if ($("#instafeed")[0]){
		var myDiv = $('#instafeed');
		var myDivTop = myDiv.offset().top;
		var myWindowHeight = $(window).height();
		var myScroll = $(document).scrollTop() + 500;
		var myElementHeight = myDiv.outerHeight();
					
		if( (myScroll+myWindowHeight) >= (myElementHeight+myDivTop) && !loading ){
			loading = true;
			
		}
	}
});
