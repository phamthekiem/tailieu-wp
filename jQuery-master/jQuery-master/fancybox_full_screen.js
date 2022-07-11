$(".call_popup").fancybox({
	    	autoSize : true,
	        scrolling : 'auto',
	        fitToView : false,
	        width : 'auto',
	        maxWidth : '100%',
	    	padding: [20,30,20,30],	    	
			helpers: {
				overlay : {
					css : {
		                'background' : 'rgba(0, 0, 0, 0.95)'
		            }
				}
			},
			tpl: {
				wrap     : '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin fancybox-skin02"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>'
			}
		});
