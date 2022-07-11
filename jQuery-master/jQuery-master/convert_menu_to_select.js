(function($) {
  function menuToSelect(menu, selectDiv){
  	var menuA = $(menu + ' a');
  	var menu = $(menu);
  	var select = '';
  	var selectDiv = $(selectDiv);
  	var curentHrefWindow = (window.location.href)?window.location.href:document.URL;
  	if(menu.length > 0 && selectDiv.length > 0){
  		select = $("<select />").appendTo(selectDiv);
  		$("<option />", {
  		   "selected": "selected",
  		   "value"   : "",
  		   "text"    : "Category"
  		}).appendTo(select);
  		menuA.each(function() {
  		 var el = $(this);	
  		 var thisHref = el.attr("href");
  		 var thisText = el.text();
  		 $("<option />", {
  			 "selected": (thisHref == curentHrefWindow)?"selected":0,
  		     "value"   : thisHref,
  		     "text"    : thisText
  		 }).appendTo(select);
  		});
  		select.change(function() {
  			if($(this).find("option:selected").val() == '') return;
  			window.location = $(this).find("option:selected").val();
  		});
  	}
  }
})(jQuery);
/*
Exam - Used
menu : Ul#menu-categories
selectDiv : div.select_cat_mobile
menuToSelect('#menu-categories','.select_cat_mobile');
*/
/*
CSS
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAGCAYAAAARx7TFAAAAVklEQVQImX3KQQ3AIBBE0bkjBTHIwUF9sBI2+4VgAwscyqUH0tD+ZC6TJ6AD98+63D0D4wMMd8+SJKAA8wUmULQXEXVHEVF1CmgPakcgSWaWgMvM0v4v8Btn7NLEpSUAAAAASUVORK5CYII=") right 10px center no-repeat #FFF !important;
    border: 1px solid #cfcfcf;
    width: 80%;
    margin: 0 auto 10px;
    display: inherit;
    padding: 5px;
    font-size: 14px;    
}
*/
