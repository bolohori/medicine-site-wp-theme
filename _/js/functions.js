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

    var mobilenav = $('.mobile-nav'),
        siteHeader = $('header');

    mobilenav.find('.menu-item-has-children > a').each(function() {
        $(this).wrap( '<div></div>' );
    });
    $('.mobile-primary > li').children().not('.sub-menu').each(function(){
        $(this).addClass('animate');
    });

    $('.mobile-primary .current_page_ancestor > .sub-menu').addClass('expanded').slideToggle();
    $('.mobile-secondary .sub-menu .current_page_item').parent().addClass('expanded').slideToggle();

    $('.current_page_ancestor .expanded > li').each(function(){
        $(this).children().first().addClass('animate');
    });

    mobilenav.find('.menu-item-has-children > div > a').each(function() {
        $(this).after( '<div class="dashicons dashicons-arrow-down-alt2 expand"></div>' );
    });
    $('.mobile-primary .current_page_ancestor > div .dashicons-arrow-down-alt2').toggleClass('dashicons-arrow-up-alt2 dashicons-arrow-down-alt2');
    $('.mobile-secondary .expanded').parent().find('.dashicons-arrow-down-alt2').toggleClass('dashicons-arrow-up-alt2 dashicons-arrow-down-alt2');

	$('#mobile-menu-icon').click(function() {
        $('html').toggleClass('stick');
        if($('#mobile-menu-icon').hasClass('open')) {
            $('.header-wrap').removeClass('pull');
            $('#mobile-menu-icon').removeClass('open');
            mobilenav.find('.active').removeClass('active');
            siteHeader.height('auto');
        } else {
            var height = siteHeader.height();
            siteHeader.height(height);
            $('.header-wrap').addClass('pull');
            function delayAnimate() { 
                mobilenav.find('.animate').each(function(i){
                    var animate = $(this);
                    setTimeout(function() {
                        animate.addClass('active');
                    }, (i+1) * 100);
                });
            }
            setTimeout(delayAnimate, 200)
            $('#mobile-menu-icon').addClass('open');
        }
        if($('#mobile-search-icon').hasClass('search-active')) {
            $('#mobile-search-form').css('top', '-62px');
            $('#mobile-search-icon').removeClass('search-active');
        }
    }); 

    $('.expand').click( function() {
        var submenu = $(this).parent().next();
        if( $(this).parent().parent().parent().parent().attr('class') == 'mobile-primary' ){
            $('.expanded').not(submenu).removeClass('expanded').slideUp();
            $('.expand').not($(this)).addClass('dashicons-arrow-down-alt2').removeClass('dashicons-arrow-up-alt2');
        }
        submenu.toggleClass('expanded').slideToggle('fast');
        $(this).toggleClass('dashicons-arrow-up-alt2 dashicons-arrow-down-alt2');

        if(submenu.hasClass('expanded')) {
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
            siteHeader.height('auto');
            $('.header-wrap').toggleClass('pull');
            $('html').removeClass('stick');
            $('#mobile-menu-icon').removeClass('open');
            mobilenav.find('.active').removeClass('active');
        }
        if($('#mobile-search-icon').hasClass('search-active')) {
            $('#mobile-search-form').animate({top:'-62px'}, {duration:300});
        } else {
            $('#mobile-search-form').animate({top:'0'}, {duration:300});
        }
        $('#mobile-search-form').toggleClass('active');
        $('#mobile-search-icon').toggleClass('search-active');
    });

    selectedyear = $('.selected-year').text();
    $('.displayed-year p').text(selectedyear);
    $('.displayed-year p').click(function() {
        $('#year-list').toggle();
        $('.displayed-year p').toggleClass('open');
    });
    $('#year-list li').click(function() {
        selectedyear = $('.selected-year').text();
        $('.displayed-year p').text(selectedyear);
        $('#year-list').hide();
        $('.displayed-year p').removeClass('open');
    });

    $('.section-nav ul').hide();
    $('.current-page-title').click(function() {
        $('.section-nav ul').toggle();
        $(this).toggleClass('open');
    });
});
