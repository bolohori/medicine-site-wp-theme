jQuery(document).ready(function($) {

	$('#billboard-slider').nivoSlider({
		effect:'fade', //Specify sets like: 'sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random'
		slices:1,
		animSpeed:500, //Slide transition speed
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:true, //Next & Prev
		directionNavHide:true, //Only show on hover
		controlNav:true, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		controlNavThumbsFromRel:false, //Use image rel for thumbs
		controlNavThumbsSearch: '.jpg', //Replace this with...
		controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0 //Universal caption opacity
	});

	$('#spotlight-slider').nivoSlider({
		effect:'fade', //Specify sets like: 'sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown, sliceUpDownLeft, fold, fade, random'
		slices:1,
		animSpeed:500, //Slide transition speed
		pauseTime:6500,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:true, //Next & Prev
		directionNavHide:true, //Only show on hover
		controlNav:true, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		controlNavThumbsFromRel:false, //Use image rel for thumbs
		controlNavThumbsSearch: '.jpg', //Replace this with...
		controlNavThumbsReplace: '_thumb.jpg', //...this in thumb Image src
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0, //Universal caption opacity
        afterLoad: function(){ // event tracking for the first slide
            var sliderData = $('#spotlight-slider').data("nivo:vars");
            var slideNum = sliderData.currentSlide + 1; // return the slider position
            var label = sliderData.currentImage.attr('alt'); // extract the alt attribute
            __gaTracker('send','event','national-leadership','slide ' + slideNum, label);
        },
        afterChange: function(){ // event tracking for subsequent slide views
            var sliderData = $('#spotlight-slider').data("nivo:vars");
            var slideNum = sliderData.currentSlide + 1; // return the slider position
            var label = sliderData.currentImage.attr('alt'); // extract the alt attribute
            __gaTracker('send','event','national-leadership','slide ' + slideNum, label);
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