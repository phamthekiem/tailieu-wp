/*
HTML chèn video youtube
Quan trọng là phải thêm ?enablejsapi=1&html5=1 vào sau đường dẫn nhé :)
by Toan
*/
/*
<iframe id="video" width="940" height="394" src="https://www.youtube.com/embed/i0l2ILzwyc8?enablejsapi=1&html5=1" frameborder="0" allowfullscreen></iframe>
*/
/*
CSS video respon 16:9
.videoWrapper {
	position: relative;
	padding-bottom: 56.25%; 
	padding-top: 25px;
	height: 0;
}
.videoWrapper iframe,.videoWrapper object,.videoWrapper embed {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
*/
/*
jQuery auto pause video when next slider
*/
var slider = $('.slider').bxSlider({
	
	onSlideAfter: function(slide, oldindex, currentSlide){
		oldSlide = $( '.slider li:nth-child(' + (oldindex+1) + ')');
		youtubeVideo = oldSlide.find('iframe[src*=youtube]');
		if ( youtubeVideo.length ) {
		  youtubeVideo.get(0).contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}','*');
		}	
	}
});