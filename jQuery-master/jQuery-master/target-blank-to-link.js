(function($){
	$(document).ready(function(){
		$('.thecontent a').each(function(){
			if(
				!$(this).hasClass('.ez-toc-link') 
				&& !(/\.(?:jpg|jpeg|gif|png)$/i.test($(this).attr('href')))
			){
				$(this).attr('target','_blank');
			}
		});
	})
})(jQuery);
