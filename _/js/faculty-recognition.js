jQuery.fn.pixels = function(property) {
	return parseInt(this.css(property).slice(0,-2));
};
	
jQuery(document).ready(function() {
	jQuery("#year-list li").on("click", function(e) {
		// We'll pass this variable to the PHP function example_ajax_request
		jQuery(".selected-year").removeClass("selected-year");
		jQuery(this).addClass("selected-year");
		var y = jQuery(this).attr("data-post_id"),
		nonce = jQuery(this).attr("data-nonce");
		 
		// This does the ajax request
		jQuery.ajax({
			type : "post",
			url: '/wp-content/themes/medicine/_/php/wusm_ajax.php',
			data: {
				'action':'get_awards',
				'year' : y,
				'nonce' : nonce
			},
			success:function(data) {
				// This outputs the result of the ajax request
				jQuery('#award-years-right').html(data);
				jQuery('.faculty-individual').matchHeight();
			},
			error: function(errorThrown){
				/*console.log(errorThrown);*/
			}
		});
	});

	jQuery(".photo-container a:nth-child(4)").addClass("fourth");
		
	jQuery(".spacer-container").hover(
		function() {
			jQuery(this).children(".view-all").slideToggle();
		}
	);
		
	jQuery(".left-arrow").click(function() {
		p = jQuery(this).prevAll(".photo-container");
		c = -1 * p.pixels('left');
		t = p.children().length * 81;
		if( c > 648 ) {
			p.children(".fourth").removeClass("fourth");
			m = 648;
			p.animate({left: '+=648'});
			jQuery(p.children()[(c - m) / 81 + 3]).addClass('fourth');
		} else if( c > 0 ) {
			p.children(".fourth").removeClass("fourth");
			m = 0;
			p.animate({left: m});
			jQuery(p.children()[3]).addClass('fourth');
		} else {
			p.effect("bounce", { times: 3, direction: 'right', distance: 5 }, 100);
		}
		
	});
		
	jQuery(".right-arrow").click(function() {
		p = jQuery(this).prevAll(".photo-container");
		c = -1 * p.pixels('left');
		t = p.children().length * 81;
		
		if( (c + 648 + 648 ) < t ) {
			p.children(".fourth").removeClass("fourth");
			m = 648;
			p.animate({left: '-=648'});
			jQuery(p.children()[(c + m) / 81 + 3]).addClass('fourth');
		} else if( c + 648 < t ) {
			p.children(".fourth").removeClass("fourth");
			m = t - (c + 648 );
			p.animate({left: '-=' + m});
			jQuery(p.children()[(c + m) / 81 + 3]).addClass('fourth');
		} else {
			p.effect("bounce", { times: 3, direction: 'left', distance: 5 }, 100);
		}
	});
		
	jQuery('.faculty-photo').mousemove(function(e){
		var x = e.pageX + 1;
		var y = e.pageY - 23;
		jQuery("#hover").css('left', x);
		jQuery("#hover").css('top', y);
	}).hover(function() {
		jQuery("#hover").html(jQuery(this).attr('title'));
	});
		
	jQuery('.photo-container').mouseenter(function() {
		jQuery("#hover").show();
	}).mouseleave(function() {
		jQuery("#hover").hide();
	});
	
});