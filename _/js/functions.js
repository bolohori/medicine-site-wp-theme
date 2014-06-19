// Browser detection for when you get desparate. A measure of last resort.
// http://rog.ie/post/9089341529/html5boilerplatejs

// var b = document.documentElement;
// b.setAttribute('data-useragent',  navigator.userAgent);
// b.setAttribute('data-platform', navigator.platform);

// sample CSS: html[data-useragent*='Chrome/13.0'] { ... }

// remap jQuery to $
jQuery(document).ready(function($) {
	var $window = $(window);

	// Really need to clean all these up...
	if( $('#left-col').height() > $('#main article').height() )
		$('#main article').css("min-height", $('#left-col').height() + 123);
	if( $('#right-col').height() > $('#main article').height() )
		$('#main article').css("min-height", $('#right-col').height() + 123);
	if( $(window).height() > $('#main article').height() + 630 )
		$('#main article').css("min-height", $(window).height() - 630 );
	if( $('.main-content').height() < ($(window).height()-526) )
		$('.main-content').css("min-height", $(window).height()-526);

	$(".announcements").click(function(e){
		e.preventDefault();
		$(".announcements .arrow").toggleClass("arrow-down arrow-up");
		if ( $(".information-for-div").css("display") === "block" ) {
			$(".information-for .arrow").toggleClass("arrow-down arrow-up");
			$(".information-for-div").slideToggle();
		}
		$(".announcements-div").slideToggle();
	});

	$(".information-for").click(function(e){
		e.preventDefault();
		$(".information-for .arrow").toggleClass("arrow-down arrow-up");
		if ( $(".announcements-div").css("display") === "block" ) {
			$(".announcements .arrow").toggleClass("arrow-down arrow-up");
			$(".announcements-div").slideToggle();
		}
		$(".information-for-div").slideToggle();
	});
});