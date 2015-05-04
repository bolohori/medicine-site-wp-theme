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

    if(!$('body').hasClass('page-child')) {
        $('.mobile-primary').children().each(function(i){
            $(this).addClass('animate');
        });
    }

	$('#mobile-menu-icon').click(function() {
        if(!$(this).hasClass('open')) {
            $('.mobile-nav').fadeIn('fast');
            $('.mobile-open').hide();
            $('.mobile-close').show();
        } else {
            $('.mobile-nav').fadeOut();
            $('.mobile-close').hide();
            $('.mobile-open').show();
        }
        if(!$(this).hasClass('open')) {
            if(!$('body').hasClass('page-child')) {
                $('.mobile-primary').children().each(function(i){
                    var $li = $(this);
                    setTimeout(function() {
                        $li.addClass('active');
                    }, (i+1) * 100);
                });
            }
            $(this).addClass('open');
            } else {
                $(this).removeClass('open');
                $('.mobile-primary li').removeClass('active');
            }
    });

    $('.mobile-container .close').click(function() {
        $('.mobile-container').fadeOut();
        $('#mobile-nav ul li').removeClass('active');
        $('#mobile-menu-icon').addClass('closed');
    })
    
    $('#mobile-search-icon').click(function() {
        $('#mobile-search-form').slideToggle();
    });

    $(".mobile-primary .page_item_has_children > a").each(function() {
        $(this).after( "<div class='dashicons dashicons-arrow-down-alt2 expand'></div>" );
    });

    $(".mobile-primary .menu-item-has-children > a").each(function() {
        $(this).after( "<div class='dashicons dashicons-arrow-down-alt2 expand'></div>" );
    });

    $(".expand").click( function() {
        if( $(this).parent().parent().parent().attr('class') == 'mobile-primary' ){
            $(".expanded").not($(this).next()).removeClass("expanded").slideUp();
            $(".expand").not($(this)).addClass("dashicons-arrow-down-alt2").removeClass("dashicons-arrow-up-alt2");
        }
        $(this).next().toggleClass("expanded").slideToggle();
        $(this).toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");
    });

    $(".mobile-primary .current_page_ancestor > .children").addClass("expanded").slideToggle();
    $(".mobile-primary .current_page_ancestor > .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");

    $(".mobile-primary .current_page_ancestor > .sub-menu").addClass("expanded").slideToggle();
    $(".mobile-primary .current_page_ancestor > .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");

    $(".info-for").click(function(e){
        e.preventDefault();
        $(".info-for .arrow").toggleClass("arrow-down arrow-up");
        $(".info-for ul").slideToggle();
    });
    $(".announce").click(function(e){
        e.preventDefault();
        $(".announce .arrow").toggleClass("arrow-down arrow-up");
        $(".announce ul").slideToggle();
    });
});


// Lucky Orange analytics
window.__wtw_lucky_site_id = 32316;

(function() {
    var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
    wa.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://cdn') + '.luckyorange.com/w.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
})();