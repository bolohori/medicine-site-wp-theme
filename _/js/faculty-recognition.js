jQuery.fn.pixels = function(property) {
	return parseInt(this.css(property).slice(0,-2));
};
	
jQuery(document).ready(function() {
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
		var y = e.pageY - 195;
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