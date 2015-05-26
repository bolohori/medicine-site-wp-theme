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

    $(".mobile-nav .menu-item-has-children > a").each(function() {
        $(this).wrap( "<div></div>" );
    });
    $('.mobile-primary > li').children().not('.sub-menu').each(function(){
        $(this).addClass('animate');
    });

    $(".mobile-primary .current_page_ancestor > .sub-menu").addClass("expanded").slideToggle();
    $(".mobile-secondary .sub-menu .current_page_item").parent().addClass("expanded").slideToggle();

    $('.current-page-ancestor .expanded > li').each(function(){
        $(this).children().first().addClass('animate');
    });

    $(".mobile-nav .menu-item-has-children > div > a").each(function() {
        $(this).after( "<div class='dashicons dashicons-arrow-down-alt2 expand'></div>" );
    });
    $(".mobile-nav .current_page_ancestor > div .dashicons-arrow-down-alt2").toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");

	$('#mobile-menu-icon').click(function() {
        if($('#mobile-search-icon').hasClass('search-active')) {
            $('#mobile-search-form').css('top', '-62px');
            $('#mobile-search-icon').removeClass('search-active');
            $('.search-close').hide();
            $('.search-open').show();
        }
        if(!$(this).hasClass('open')) {
            $('.mobile-nav').fadeIn();
            $('.mobile-open').hide();
            $('.mobile-close').show();
        } else {
            $('.mobile-nav').fadeOut();
            $('.mobile-close').hide();
            $('.mobile-open').show();
        }
        $('.header-wrap').toggleClass('pull');
        $('html').toggleClass('stick');
        if(!$(this).hasClass('open')) {
                $('.animate').each(function(i){
                    var $li = $(this);
                    setTimeout(function() {
                        $li.addClass('active');
                    }, (i+1) * 100);
                });
            $(this).addClass('open');
        } else {
            $(this).removeClass('open');
            $('.active').removeClass('active');
        }
    }); 

    $(".expand").click( function() {
        var submenu = $(this).parent().next();
        if( $(this).parent().parent().parent().parent().attr('class') == 'mobile-primary' ){
            $(".expanded").not(submenu).removeClass("expanded").slideUp();
            $(".expand").not($(this)).addClass("dashicons-arrow-down-alt2").removeClass("dashicons-arrow-up-alt2");
        }
        $(submenu).toggleClass("expanded").slideToggle("fast");
        $(this).toggleClass("dashicons-arrow-up-alt2 dashicons-arrow-down-alt2");

        if((submenu).hasClass('expanded')) {
            $(submenu).children().each(function(){
                $(this).children().first().addClass('animate active');
            });
            $(submenu).find('.expanded').each(function(){
                $(this).children().each(function(){
                    $(this).children().addClass('animate active');
                });
            });
        } else {
            $(submenu).children().not('.sub-menu').each(function(){
                $(this).find('.animate').removeClass('animate');
            });
        }
    });

    $('#mobile-search-icon').click(function() {
        if($('#mobile-menu-icon').hasClass('open')) {
            $('.mobile-nav').fadeOut();
            $('.mobile-close').hide();
            $('.mobile-open').show();
            $('.header-wrap').toggleClass('pull');
            $('html').removeClass('stick');
            $('#mobile-menu-icon').removeClass('open');
            $('.active').removeClass('active');
        }
        if($(this).hasClass('search-active')) {
            $('#mobile-search-form').animate({top:'-62px'}, {duration: 300});
            $('.search-close').hide();
            $('.search-open').show();
        } else {
            $('#mobile-search-form').animate({top:'0'}, {duration: 300, complete: function() { $('#mobile-search-form input').focus(); }
            });
            $('.search-open').hide();
            $('.search-close').show();
        }
        $('#mobile-search-form').toggleClass('active');
        $(this).toggleClass('search-active');
    });
});

jQuery(document).ready(function($) {
    selectedyear = jQuery('.selected-year').text();
    jQuery('.displayed-year p').text(selectedyear);
    $('.displayed-year p').click(function() {
        $('#year-list').toggle();
    });
    $('#year-list li').click(function() {
        selectedyear = jQuery('.selected-year').text();
        jQuery('.displayed-year p').text(selectedyear);
        $('#year-list').hide();
    });
});
