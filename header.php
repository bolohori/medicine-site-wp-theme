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

	<title><?php wp_title(); ?></title>

	<meta name="title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?>">
	<meta name="author" content="Washington University School of Medicine in St. Louis">

	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"> -->

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
	if ( get_field('page_specific_css') ) { ?>
	<style>
	<?php the_field('page_specific_css'); ?>
	
</style>
	<?php }
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

	<nav id="utility-bar" class="clearfix">
		<div class="wrapper top-nav">
			<ul id="action-nav">
				<li><a href="http://wuphysicians.wustl.edu/directory.aspx" onclick="javascript:_gaq.push(['_trackEvent','utility-nav','WU Physicians']);">Find a Doctor</a></li>
				<li><a onclick="javascript:_gaq.push(['_trackEvent','utility-nav','Admissions']);" href="<?php echo get_permalink( get_page_by_title( 'Admissions' ) );?>">Admissions</a></li>
				<li><a onclick="javascript:_gaq.push(['_trackEvent','utility-nav,'Giving']);" href="<?php echo get_permalink( get_page_by_title( 'Giving' ) );?>">Giving</a></li>
			</ul>
			<ul id="utility-nav">
				<li><a class="information-for" onclick="javascript:_gaq.push(['_trackEvent','utility-nav','information-for-open']);" href="">Information for <span class="arrow arrow-down">&nbsp;</span></a></li>
				<li><a class="announcements" onclick="javascript:_gaq.push(['_trackEvent','utility-nav','announcements-open']);" href="">Announcements <span class="arrow arrow-down">&nbsp;</span></a></li>
				<li><a onclick="javascript:_gaq.push(['_trackEvent','utility-nav','WUSTL']);" href="http://www.wustl.edu">WUSTL</a></li>
				<li class="last-child"><a onclick="javascript:_gaq.push(['_trackEvent','utility-nav','Directories']);" href="/directory">Directories</a></li>
			</ul>
		</div>
	</nav>

	<div class="announcements-div hidden-header">
		<div class="wrapper">
			<div class="announcements-left">
				<h2>Announcements</h2>
				<p>Updates on campus events, policy changes, road and building construction, calls for papers and more.</p>
			</div>
			<div class="announcements-right">
				<ul class="announcement-list" data-columns="2">
		<?php
			$num_to_show = get_option( 'announcements_to_show', 6 );

			$args = array(
				'post_type' => 'announcement', 
				'posts_per_page' => $num_to_show, 
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'fields' => 'ids',
				'meta_query' => array(
					array(
						'key' => 'sticky',
						'value' => 1,
						'compare' => '=',
					)
				)
			);
			$loop = new WP_Query( $args );
			$ids = $loop->posts;
			$num_to_show = $num_to_show - sizeof( $ids );

			if( $num_to_show > 0 ) {
				$args = array(
					'post_type' => 'announcement', 
					'posts_per_page' => $num_to_show, 
					'orderby' => 'date',
					'fields' => 'ids',
					'post__not_in' => $ids,
					'meta_query' => array(
						'relation' => 'OR',
						array(
							'type' => 'DATETIME',
							'key' => 'expiration_date',
							'value' => date_i18n("Y-m-d H:i:s"),
							'compare' => '>',
						),
						array(
							'key' => 'expiration_date',
							'value' => '',
							'compare' => '=',
						)
					)
				);
				$loop = new WP_Query( $args );
				$ids = array_merge( $ids, $loop->posts );
			}

			$args = array(
				'post_type' => 'announcement',
				'orderby' => 'post__in',
				'post__in' => $ids
			);
			
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
				$internal_only = get_field('internal_only');
				if ( $internal_only && !WASHU_IP ) {
					echo "internal";
					continue;
				}
				$link = get_field('url');
				
				if( $link['url'] != '' ) {
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
				} else {
					$url = get_permalink();
				}
				echo "\t\t\t\t\t<li class='announcement'><a href='$url' onclick=\"javascript:_gaq.push(['_trackEvent','outbound-announcement','$url']);\">" . get_the_title() . "</a></li>\n";
				
			endwhile;
			wp_reset_query();
		?>
				</ul>
			</div>
			<p class="announcements">close <span class="arrow arrow-down">&nbsp;</span></p>
		</div>
	</div>

	<div class="information-for-div hidden-header">
		<div class="wrapper">
			<div class="information-for-left">
				<h2>Information for Our Community</h2>
				<p>Whether you are part of our community or are interested in joining us, we welcome you to Washington University School of Medicine.</p>
			</div>
			<div class="information-for-right">
				<ul class="information-for-list" data-columns="2">
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Prospective Students']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Prospective Students' ) );?>">Prospective Students</a></li>
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Current Students']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Current Students' ) );?>">Current Students</a></li>
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Faculty']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Faculty' ) );?>">Faculty</a></li>
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Staff']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Staff' ) );?>">Staff</a></li>
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Alumni']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Alumni & Friends' ) );?>">Alumni &amp; Friends</a></li>
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Administrators']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Administrators' ) );?>">Administrators</a></li>
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','facebook']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Researchers' ) );?>">Researchers</a></li>
					<li class="information-for-li"><a onclick="javascript:_gaq.push(['_trackEvent','sticky-footer','Researchers']);" href="<?php echo get_permalink( get_page_by_title( 'Information for Job Seekers' ) );?>">Job Seekers</a></li>
				</ul>
			</div>
			<p class="information-for">close <span class="arrow arrow-down">&nbsp;</span></p>
		</div>
	</div>

	<div id="header-site-row" class="clearfix">
		<div class="wrapper">
			<?php /*<div id="mobile-menu-icon"><img src="<?php echo get_template_directory_uri(); ?>/_/img/mobile-menu-icon.png"></div>*/ ?>

			<div id="site-title"><a href="<?php echo home_url(); ?>"><img id="print-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/wusm-logo.png" alt="Washington University School of Medicine in St. Louis"/><img id="screen-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/header-logo.png" alt="Washington University School of Medicine in St. Louis"/></a></div>
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
