// Browser detection for when you get desparate. A measure of last resort.
// http://rog.ie/post/9089341529/html5boilerplatejs

// var b = document.documentElement;
// b.setAttribute('data-useragent',  navigator.userAgent);
// b.setAttribute('data-platform', navigator.platform);

// sample CSS: html[data-useragent*='Chrome/13.0'] { ... }

// remap jQuery to $
jQuery(document).ready(function($) {
	var $window = $(window);

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

	$('#mobile-menu-icon').click(function() {
        $('#mobile-nav').slideToggle();
    });
    
    $('#mobile-search-icon').click(function() {
        $('#mobile-search-form').slideToggle();
    });

    $("#mobile-nav .page_item_has_children > a").each(function() {
        $(this).after( "<div class='dashicons dashicons-arrow-down-alt2 expand'></div>" );
    });

    $("#mobile-nav .menu-item-has-children > a").each(function() {
        $(this).after( "<div class='dashicons dashicons-arrow-down-alt2 expand'></div>" );
    });

    $(".expand").click( function() {
        if( $(this).parent().parent().parent().attr('id') == 'mobile-nav' ){
            $(".expanded").not($(this).next()).removeClass("expanded").slideUp();
            $(".expand").not($(this)).addClass("dashicons-arrow-down-alt2").removeClass("dashicons-arrow-up-alt2");
        }
        $(this).next().toggleClass("expanded").slideToggle();
        $(this).toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");
    });

    $("#mobile-nav .current_page_ancestor > .children").addClass("expanded").slideToggle();
    $("#mobile-nav .current_page_ancestor > .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");

    $("#mobile-nav .current_page_ancestor > .sub-menu").addClass("expanded").slideToggle();
    $("#mobile-nav .current_page_ancestor > .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");
});


// Lucky Orange analytics
window.__wtw_lucky_site_id = 32316;

(function() {
    var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
    wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://cdn') + '.luckyorange.com/w.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
})();