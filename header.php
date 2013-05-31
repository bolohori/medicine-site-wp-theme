<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>	 <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>	 <html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>	 <html class="ie ie9 ie-lt10 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="www-sitename-com" data-template-set="html5-reset">

    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

    <meta name="title" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Google will often use this as its description of your page/site. Make it good. -->

    <meta name="google-site-verification" content="" />
    <!-- Speaking of Google, don't forget to set your site up: http://google.com/webmasters -->

    <meta name="author" content="" />
    <meta name="Copyright" content="" />

    <!--  Mobile Viewport Fix
    http://j.mp/mobileviewport & http://davidbcalhoun.com/2010/viewport-metatag
    device-width : Occupy full width of the screen in its current orientation
    initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
    maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
    -->
    <!-- Uncomment to use; use thoughtfully!
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    -->

    <!-- Iconifier might be helpful for generating favicons and touch icons: http://iconifier.net -->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/_/img/favicon.ico" />
    <!-- This is the traditional favicon.
         - size: 16x16 or 32x32
         - transparency is OK -->

    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/_/img/apple-touch-icon.png" />
    <!-- The is the icon for iOS's Web Clip and other things.
         - size: 57x57 for older iPhones, 72x72 for iPads, 114x114 for retina display (IMHO, just go ahead and use the biggest one)
         - To prevent iOS from applying its styles to the icon name it thusly: apple-touch-icon-precomposed.png
         - Transparency is not recommended (iOS will put a black BG behind the icon) -->

    <!-- concatenate and minify for production -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/_/css/reset.css" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/_/css/style.css" />

    <?php
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
    ?>
</head>

<body <?php body_class(); ?>>

<div class="wrapper"><!-- not needed? up to you: http://camendesign.com/code/developpeurs_sans_frontieres -->

    <header>

        <h1><a href="/">Page Title</a></h1>

        <nav>

            <?php wp_nav_menu( array(
                'theme_location' => 'header-menu',
                'items_wrap'	  => '<ul>%3$s</ul>',
            ) ); ?>

        </nav>

    </header>