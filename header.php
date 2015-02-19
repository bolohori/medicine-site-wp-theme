<!doctype html>

<html class="no-js" lang="en">

<head data-template-set="html5-reset">
	<meta charset="utf-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?> | <?php is_front_page() ? 'Washington University School of Medicine in St. Louis' : bloginfo('name'); ?>">
	<meta name="author" content="Washington University School of Medicine in St. Louis">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/_/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/_/img/apple-touch-icon.png">

	<?php
	if ( get_field('page_specific_css') ) { ?>
<style>
	<?php the_field('page_specific_css'); ?>
</style>
<?php }
if(defined('WP_LOCAL_INSTALL')) { ?>
	<script type="text/javascript">
	var _gaq = _gaq || [];
	</script>
<?php }
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<!--[if IE 7 ]>  <body <?php body_class('ie ie7 ie-lt10 ie-lt9 ie-lt8'); ?>> <![endif]-->
<!--[if IE 8 ]>  <body <?php body_class('ie ie8 ie-lt10 ie-lt9'); ?>> <![endif]-->
<!--[if IE 9 ]>  <body <?php body_class('ie ie9 ie-lt10'); ?>> <![endif]-->
<!--[if gt IE 9]><!--><body <?php body_class(); ?>><!--<![endif]-->

<img id="print-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/wusm-logo-print.png" alt="Washington University School of Medicine in St. Louis"/>
<header>

	<nav id="utility-bar" class="clearfix">
		<div class="wrapper top-nav">
			<ul id="action-nav">
				<li><a href="http://wuphysicians.wustl.edu/directory.aspx" onclick="__gaTracker('send','event','utility-nav','WU Physicians');">Find a Doctor</a></li>
				<li><a onclick="__gaTracker('send','event','utility-nav','Admissions');" href="<?php echo get_permalink( get_page_by_title( 'Admissions' ) );?>">Admissions</a></li>
				<li><a onclick="__gaTracker('send','event','utility-nav','Giving');" href="<?php echo get_permalink( get_page_by_title( 'Giving' ) );?>">Giving</a></li>
			</ul>
			<ul id="utility-nav" class="clearfix">
				<li><a class="information-for" onclick="__gaTracker('send','event','utility-nav','information-for-open');" href="">Information for <span class="arrow arrow-down">&nbsp;</span></a></li>
				<li><a class="announcements" onclick="__gaTracker('send','event','utility-nav','announcements-open');" href="">Announcements <span class="arrow arrow-down">&nbsp;</span></a></li>
				<li class="utility-wustl"><a onclick="__gaTracker('send','event','utility-nav','WUSTL');" href="http://www.wustl.edu">WUSTL</a></li>
				<li class="utility-directories last-child"><a onclick="__gaTracker('send','event','utility-nav','Directories');" href="/directory">Directories</a></li>
			</ul>
		</div>
	</nav>

	<div class="announcements-div hidden-header clearfix">
		<div class="wrapper">
			<div class="announcements-left">
				<h2>Announcements</h2>
				<p>Updates on campus events, policy changes, road and building construction, calls for papers and more.</p>
			</div>
			<div class="announcements-right">
				<ul class="announcement-list">
		<?php
			$num_to_show = get_option( 'announcements_to_show', 6 );
			$i = 0;
			
			// Using this to order down instead of across
			$num_per_column = floor( $num_to_show / 2 );

			// First off, lets get all the 'sticky' announcements,
			// ordered by their drag-n-drop position
			$args = array(
				'post_type'      => 'announcement', 
				'posts_per_page' => $num_to_show, 
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'fields'         => 'ids',
				'meta_key'       => 'sticky',
				'meta_value'     => 1
			);
			$loop = new WP_Query( $args );
			$ids = $loop->posts;
			
			// Just decrement the number to show by the 
			// number of 'sticky's found
			$num_to_show = $num_to_show - sizeof( $ids );

			// We have more to show than just 'sticky's
			if( $num_to_show > 0 ) {
				$args = array(
					'post_type'      => 'announcement', 
					'posts_per_page' => $num_to_show, 
					'orderby'        => 'date',
					'fields'         => 'ids',
					'post__not_in'   => $ids
				);
				$loop = new WP_Query( $args );
				$ids = array_merge( $ids, $loop->posts );
			}

			// Take the array from the first two loops
			// and mash it into one huge array of ids
			// to get
			$args = array(
				'post_type' => 'announcement',
				'orderby'   => 'post__in',
				'post__in'  => $ids,
				'meta_query'=> array(
					'relation'   => 'OR',
					array(
						'type'    => 'DATETIME',
						'key'     => 'expiration_date',
						'value'   => date_i18n("Y-m-d H:i:s"),
						'compare' => '>',
					),
					array(
						'key'     => 'expiration_date',
						'value'   => '',
						'compare' => '=',
					)
				)
			);
			
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) {
				$loop->the_post();
				if( $i == $num_per_column ) {
					echo '</ul>';
					echo '<ul class="announcement-list">';
				}
				$internal_only = get_field('internal_only');
				if ( $internal_only && !WASHU_IP ) {
					continue;
				}
				$link = get_field('url');
				
				if( $link['url'] != '' ) {
					$url = (strpos($link['url'], "http") !== false) ? $link['url'] : "http://" . $link['url'];
				} else {
					$url = get_permalink();
				}
				$title = get_the_title();
				echo "\t\t\t\t\t<li class='announcement'><a href='$url' onclick=\"__gaTracker('send','event','header-announcement','$title');\">$title</a></li>\n";
				$i++;
			}
			wp_reset_query();
		?>
				</ul>
			</div>
			<p class="announcements">close <span class="arrow arrow-down">&nbsp;</span></p>
		</div>
	</div>

	<div class="information-for-div hidden-header clearfix">
		<div class="wrapper">
			<div class="information-for-left">
				<h2>Information for Our Community</h2>
				<p>Whether you are part of our community or are interested in joining us, we welcome you to Washington University School of Medicine.</p>
			</div>
			<div class="information-for-right">
				<ul class="information-for-list">
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','Prospective Students');" href="<?php echo get_permalink( get_page_by_title( 'Information for Prospective Students' ) );?>">Prospective Students</a></li>
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','Current Students');" href="<?php echo get_permalink( get_page_by_title( 'Information for Current Students' ) );?>">Current Students</a></li>
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','Faculty');" href="<?php echo get_permalink( get_page_by_title( 'Information for Faculty' ) );?>">Faculty</a></li>
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','Staff');" href="<?php echo get_permalink( get_page_by_title( 'Information for Staff' ) );?>">Staff</a></li>
				</ul>
				<ul class="information-for-list">
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','Alumni');" href="<?php echo get_permalink( get_page_by_title( 'Information for Alumni & Friends' ) );?>">Alumni &amp; Friends</a></li>
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','Administrators');" href="<?php echo get_permalink( get_page_by_title( 'Information for Administrators' ) );?>">Administrators</a></li>
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','facebook');" href="<?php echo get_permalink( get_page_by_title( 'Information for Researchers' ) );?>">Researchers</a></li>
					<li class="information-for-li"><a onclick="__gaTracker('send','event','information-for','Researchers');" href="<?php echo get_permalink( get_page_by_title( 'Information for Job Seekers' ) );?>">Job Seekers</a></li>
				</ul>
			</div>
			<p class="information-for">close <span class="arrow arrow-down">&nbsp;</span></p>
		</div>
	</div>

	<div id="header-site-row" class="clearfix">
		<div class="wrapper clearfix">
			<div id="mobile-search-icon"><div class="dashicons dashicons-search"></div></div>
            <div id="mobile-menu-icon"><div class="dashicons dashicons-menu"></div></div>
			<div id="site-title"><a href="<?php echo home_url(); ?>"><img id="screen-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/wusm-logo.svg" width="607" height="33" onerror="this.src='<?php echo get_template_directory_uri(); ?>/_/img/header-logo.png';this.onerror=null;" alt="Washington University School of Medicine in St. Louis"/></a></div>
			<div id="site-title-text"><a href="<?php echo home_url(); ?>">Washington University School of Medicine</a></div>
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

	<div class="mobile-container">
        <form method="get" id="mobile-search-form" autocapitalize="none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" name="s" id="mobile-search-box" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}" placeholder="<?php esc_attr_e( 'Search' ); ?>">
        </form>

        <nav id="mobile-nav">
            <ul>
                <?php
                wp_nav_menu( array(
                	'theme_location' => 'mobile-menu',
                	'container' => false,
                    'items_wrap' => '%3$s',
                    'echo' => true,
                ) );
                ?>
            </ul>
        </nav>
    </div>

</header>
