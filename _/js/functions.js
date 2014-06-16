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
		$('#main article').css("min-height", $('#left-col').height() + 123);
	} else if( $('#right-col').height() > $('#main article').height() ) {
		$('#main article').css("min-height", $('#right-col').height() + 123);
	} else if( $(window).height() > $('#main article').height() + 630 ) {
		$('#main article').css("min-height", $(window).height() - 630 );
	}

	// your functions go here
	if ( $('#billboard-slider')[0] ) {
		$('#billboard-slider').nivoSlider({pauseTime: 5000, effect:'fade'});
		$('#news-slider').nivoSlider({manualAdvance: true, effect:'fade'});
		$('#spotlight-slider').nivoSlider({manualAdvance: true, effect:'slideInLeft'});
	}

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

	if ( $('audio')[0] ) {
		$('.audio-file').click(function(e){
			var action = $(this).text();

			// Prevent the link from firing and pause anything that
			// may be playing
			e.preventDefault();
			$('audio').each(function() {$(this)[0].player.pause();});

			// If there is an open audio player, change the label back
			// and close the player
			$('.open-audio-label').text('Listen').removeClass('.open-audio-label');
			$('.open-audio').slideUp().removeClass('open-audio');
			
			if(action === 'Listen') {
				// Grab the ID of the audio player container from the data
				// attribute of the <li> and start playing the file
				audio_container = "#" + $(this).data('id');
				$(audio_container + ' audio').each(function() {$(this)[0].player.play();});

				// Add class to audio player and open it and change the
				// label that was clicked on
				$(audio_container).addClass('open-audio').slideToggle();
				$(this).text('Hide').addClass('open-audio-label');
			}
			
		});
	}

	if($('.main-content').height() < ($(window).height()-526))
		$('.main-content').css("min-height", $(window).height()-526);
});