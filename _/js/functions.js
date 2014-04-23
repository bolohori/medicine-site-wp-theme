// Browser detection for when you get desparate. A measure of last resort.
// http://rog.ie/post/9089341529/html5boilerplatejs

// var b = document.documentElement;
// b.setAttribute('data-useragent',  navigator.userAgent);
// b.setAttribute('data-platform', navigator.platform);

// sample CSS: html[data-useragent*='Chrome/13.0'] { ... }

// remap jQuery to $
jQuery(document).ready(function($) {
	/*var ಠ_ಠ = 3.14;
	console.log(ಠ_ಠ);*/

	// jPanelMenu
/*	var jPM = $.jPanelMenu({
		menu: '#mobile-nav',
		trigger: '#mobile-menu-icon',
		direction: 'right',
		keyboardShortcuts: false,
		excludedPanelContent: '#wpadminbar'
	});
	jPM.on();*/

	/* trigger when page is ready */
	var $window = $(window);

	if( $('#left-col').height() > $('#main article').height() ) {
		$('#main article').height($('#left-col').height() + 123);
	} else if( $('#right-col').height() > $('#main article').height() ) {
		$('#main article').height($('#right-col').height() + 123);
	} else if( $(window).height() > $('#main article').height() + 640 ) {
		$('#main article').height($(window).height() - 640 );
	}

	// your functions go here
	if ( $('#slider')[0] ) {
		$('#slider').nivoSlider({pauseTime: 5000, effect:'fade'});
		$('#news-slider').nivoSlider({manualAdvance: true, effect:'fade'});
		$('#spotlight-slider').nivoSlider({manualAdvance: true, effect:'slideInLeft'});
	}

	/*var last = document.referrer,
		curr = window.location.href,
		last_a = last.split("/"),
		curr_a = curr.split("/");

	if(last_a[2] != curr_a[2]) {
		$('.sticky-footer').animate({'bottom': 0}, 800);
	} else { */
		$('.sticky-footer').css({'bottom': 0});
	/*}*/


	if ( $('.landing-page')[0] && $(".page-nav")[0] ) {
		var $sidebar = $(".page-nav");

		$window.scroll(function () {
			if( ($window.scrollTop()) > 392 ) {
				$sidebar.css({'position':'fixed', 'top':'56px', 'background':'#fff', 'padding-right':'7px'});
			} else {
				$sidebar.css({'position':'static'});
			}
		});
	}

	$(".announcements").click(function(e){e.preventDefault();$(".hidden-footer").slideToggle();});

	if ( $('audio')[0] ) {
		$('.audio-file').click(function(e){
			e.preventDefault();
			audio_container = "#" + $(this).data('id');
			$(audio_container).slideToggle();
			if($(this).text() == 'Listen') { $(this).text('Hide'); } else { $(this).text('Listen'); $('audio').each(function() {$(this)[0].player.pause();}); }
		});
	}

	if($('.main-content').height() < ($(window).height()-526))
		$('.main-content').height($(window).height()-526);

});