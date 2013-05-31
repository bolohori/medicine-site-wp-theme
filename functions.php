<?php
/*
 * Include ACF custom fields
 * 
 */
if(!defined('WP_LOCAL_INSTALL')) {
	require_once( get_stylesheet_directory() . '/_/php/acf_fields.php' );
}

/*
 * Create post type for "Front Page settings"
 */
require_once( get_stylesheet_directory() . '/_/php/custom_post_types.php' );

/*
 * Load JavaScripts
 */
require_once( get_stylesheet_directory() . '/_/php/load_js.php' ); 

/**
 * Customise the footer in admin area
 */
function wpfme_footer_admin () {
	echo 'Theme designed and developed by WUSTL Medical Public Affairs and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}
add_filter('admin_footer_text', 'wpfme_footer_admin');

/**
 * Intialize all the theme options
 */
function theme_init() {
    // Create Header Menu theme location
    register_nav_menus(
        array( 'header-menu' => 'Header Menu' )
    );

    register_sidebar();

    if ( !is_nav_menu( 'Header' )) {
        // Create Header menu, if it doesn't already exist
        $menu_id = wp_create_nav_menu( 'Header', array( 'slug' => 'header' ) );

        // Add Home to the Header menu
        $menu_item = array(
            'menu-item-type' => 'custom',
            'menu-item-url' => get_home_url('/'),
            'menu-item-title' => 'Home',
            'menu-item-status' => 'publish',
        );
        wp_update_nav_menu_item( $menu_id, 0, $menu_item );

        // Add Sample Page to the Header menu
        $page = get_page_by_title('Sample Page');
        $menu_item = array(
            'menu-item-object-id' => $page->ID,
            'menu-item-object'    => 'page',
            'menu-item-type'      => 'post_type',
            'menu-item-status'    => 'publish'
        );
        wp_update_nav_menu_item( $menu_id, 0, $menu_item );

        // Assign Header menu to the Header Menu theme location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['header-menu'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

	// Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Manual excerpts for pages as well as posts
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'theme_init' );


// Set default timezone
function set_timezone() {
    update_option( 'timezone_string', 'America/Chicago' );
}
add_action( 'init', 'set_timezone' );


function enable_editor_styles() {
    add_editor_style();
}
add_action( 'init', 'enable_editor_styles' );

/*********************
WP_HEAD GOODNESS
The default wordpress head is a mess. Let's clean it up by
removing all the junk we don't need.
*********************/
function head_cleanup() {
	// category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );
} /* end bones head cleanup */
add_action('init', 'head_cleanup');

// remove WP version from scripts
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove WP version from RSS
add_filter('the_generator', 'strip_rss_version');

// remove WP version from RSS
function strip_rss_version() { return ''; }

// Hide admin bar for subscribers.	Probably won't be needed, but just in case
function cc_hide_admin_bar() {
	if (!current_user_can('edit_posts')) {
		show_admin_bar(false);
	}
}
add_action('set_current_user', 'cc_hide_admin_bar');
