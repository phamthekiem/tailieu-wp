/*auto play khi đã click vào next hoặc prev*/
var slider = $('.slider').bxSlider();

$('.bx-pager-item a').click(function(e){
	var i = $(this).attr('data-slide-index');
	slider.goToSlide(i);
	slider.stopAuto();
	restart=setTimeout(function(){
		slider.startAuto();
	},500);
	return false;
});