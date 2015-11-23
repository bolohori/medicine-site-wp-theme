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

    (function(e){e.InFieldLabels=function(n,i,t){var a=this;a.$label=e(n),a.label=n,a.$field=e(i),a.field=i,a.$label.data("InFieldLabels",a),a.showing=!0,a.init=function(){var n;a.options=e.extend({},e.InFieldLabels.defaultOptions,t),a.options.className&&a.$label.addClass(a.options.className),setTimeout(function(){""!==a.$field.val()?(a.$label.hide(),a.showing=!1):(a.$label.show(),a.showing=!0)},200),a.$field.focus(function(){a.fadeOnFocus()}).blur(function(){a.checkForEmpty(!0)}).bind("keydown.infieldlabel",function(e){a.hideOnChange(e)}).bind("paste",function(){a.setOpacity(0)}).change(function(){a.checkForEmpty()}).bind("onPropertyChange",function(){a.checkForEmpty()}).bind("keyup.infieldlabel",function(){a.checkForEmpty()}),a.options.pollDuration>0&&(n=setInterval(function(){""!==a.$field.val()&&(a.$label.hide(),a.showing=!1,clearInterval(n))},a.options.pollDuration))},a.fadeOnFocus=function(){a.showing&&a.setOpacity(a.options.fadeOpacity)},a.setOpacity=function(e){a.$label.stop().animate({opacity:e},a.options.fadeDuration,function(){0===e&&a.$label.hide()}),a.showing=e>0},a.checkForEmpty=function(e){""===a.$field.val()?(a.prepForShow(),a.setOpacity(e?1:a.options.fadeOpacity)):a.setOpacity(0)},a.prepForShow=function(){a.showing||(a.$label.css({opacity:0}).show(),a.$field.bind("keydown.infieldlabel",function(e){a.hideOnChange(e)}))},a.hideOnChange=function(e){16!==e.keyCode&&9!==e.keyCode&&(a.showing&&(a.$label.hide(),a.showing=!1),a.$field.unbind("keydown.infieldlabel"))},a.init()},e.InFieldLabels.defaultOptions={fadeOpacity:.5,fadeDuration:300,pollDuration:0,enabledInputTypes:["text","search","tel","url","email","password","number","textarea"],className:!1},e.fn.inFieldLabels=function(n){var i=n&&n.enabledInputTypes||e.InFieldLabels.defaultOptions.enabledInputTypes;return this.each(function(){var t,a,o=e(this).attr("for");o&&(t=document.getElementById(o),t&&(a=e.inArray(t.type,i),(-1!==a||"TEXTAREA"===t.nodeName)&&new e.InFieldLabels(this,t,n)))})}})(jQuery);


    $("#search-form label").inFieldLabels({ fadeDuration: 0 });
    $(".search-news label").inFieldLabels({ fadeDuration: 0 });
    $('#search-btn').attr('disabled', 'disabled');
    $('#search-btn-news').attr('disabled', 'disabled');
    $searchBox = $('#search-box');
    $searchBtn = $('#search-btn');
    $searchBoxNews = $('#search-box-news');
    $searchBtnNews = $('#search-btn-news');
    $searchBox.keyup(function() {
        var empty = false;
        if ($searchBox.val() == '') {
            empty = true;
        }
        if (empty) {
            $searchBtn.attr('disabled', 'disabled');
        } else {
            $searchBtn.removeAttr('disabled');
        }
    });
    $searchBoxNews.keyup(function() {
        var emptyNews = false;
        if ($searchBoxNews.val() == '') {
            emptyNews = true;
        }
        if (emptyNews) {
            $searchBtnNews.attr('disabled', 'disabled');
        } else {
            $searchBtnNews.removeAttr('disabled');
        }
    });
});

function next_posts() {
    var counter = 2;
    jQuery(".next-posts a").click(function(a) {
        jQuery.get(jQuery(this).attr("href"), function(a) {
            jQuery(".pagination .next-posts a", a).length > 0 ? jQuery(".next-posts a").attr("href", jQuery(".pagination .next-posts a", a).attr("href")) : jQuery(".pagination").remove(), jQuery(".news-cards").append(jQuery(".news-cards ul", a).addClass('page' + counter))
        }).done(function() { 
            jQuery('.page' + counter).imagesLoaded().then(function(){
                jQuery('.page' + counter + ' .card').matchHeight(); counter++;
            });
        } ), a.preventDefault()
    })
}

jQuery(document).ready(function($) {
    $('.news-filters ul > li.parent > a').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $('.news-filters .open').not($(this)).removeClass('open');
        $(this).toggleClass('open');
    });
    $('.news-filters > .search > .search-btn').click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $('.news-filters .open').not($('.search-news')).removeClass('open');
        $('.news-filters .visible').removeClass('visible');
        $('.news-filters').toggleClass('search-open');
        $('.search-news').toggleClass('open');
        if($('.search-news').hasClass('open')) {
            $('#search-box-news').focus();
        }
    });
    $('.news-filters .collapse').click(function(e) {
        e.stopPropagation();
        $('.news-filters .collapse').toggleClass('visible');
        jQuery('.news-filters .open').removeClass('open');
    });
    $('.next-posts').length > 0 && next_posts()
});

jQuery(document).click( function(e) {
    if( !jQuery(e.target).closest(".open").length > 0 ) {
        jQuery('.news-filters .open').removeClass('open');
    }
});



jQuery.fn.imagesLoaded = function () {

    // Edit: in strict mode, the var keyword is needed
    var $imgs = this.find('img[src!=""]');
    // if there's no images, just return an already resolved promise
    if (!$imgs.length) {return jQuery.Deferred().resolve().promise();}

    // for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
    var dfds = [];  
    $imgs.each(function(){

        var dfd = jQuery.Deferred();
        dfds.push(dfd);
        var img = new Image();
        img.onload = function(){dfd.resolve();}
        img.onerror = function(){dfd.resolve();}
        img.src = this.src;

    });

    // return a master promise object which will resolve when all the deferred objects have resolved
    // IE - when all the images are loaded
    return jQuery.when.apply(jQuery,dfds);

}
