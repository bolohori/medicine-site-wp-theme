<!doctype html>

<!--[if lt IE 7 ]> <html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>	 <html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>	 <html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>	 <html class="ie ie9 ie-lt10 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="sitename-wustl-edu" data-template-set="html5-reset">
	<meta charset="utf-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php echo is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?></title>

	<meta name="title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?>">
	<meta name="author" content="Washington University School of Medicine in St. Louis">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon.png">

	<!--[if gte IE 9]>
	<style type="text/css">
		.gradient {
			filter: none;
		}
	</style>
	<![endif]-->

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

<header>

	<div id="header-site-row" class="clearfix">
		<div class="wrapper">
			<nav id="utility-bar" class="clearfix">
				<ul id="utility-nav">
					<li><a onclick="javascript:_gaq.push(['_trackEvent','utility-nav','http://wustl.edu/']);" href="http://wustl.edu/">WUSTL</a></li>
					<li class="last-child"><a onclick="javascript:_gaq.push(['_trackEvent','utility-nav','http://medicine.wustl.edu/directory']);" href="http://medicine.wustl.edu/directory">Directories</a></li>
				</ul>
			</nav>

			<div id="mobile-menu-icon"><img src="<?php echo get_template_directory_uri(); ?>/_/img/mobile-menu-icon.png"></div>
			
			<div id="site-title"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/header-logo.png" alt="Washington University School of Medicine in St. Louis"/></a></div>
			<?php get_search_form(); ?>
		</div>
	</div>

	<?php wp_nav_menu( array(
		'theme_location' => 'header-menu',
		'menu'           => 'header',
		'container'      => 'nav',
		'container_id'   => 'main-nav',
		'items_wrap'     => '<div class="wrapper"><ul>%3$s</ul></div>',
	) ); ?>

</header>