jQuery(document).ready(function($) {

	$('.billboard-slider').bxSlider({
		mode: 'fade',
		auto: true,
		pause: 4500,
		onSliderLoad: function(){
	    	$('.billboard').css("visibility", "visible");
	    }
	});

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
});