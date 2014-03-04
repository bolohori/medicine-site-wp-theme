<?php
if(!defined('WP_LOCAL_INSTALL')) {
	require_once( get_template_directory() . '/_/php/acf_fields.php' );
}

require_once( get_template_directory() . '/_/php/custom_post_types.php' );
require_once( get_template_directory() . '/_/php/load_js.php' );
require_once( get_template_directory() . '/_/php/sidebar_helper.php' );

add_action( 'init', 'wusm_head_cleanup' );
add_filter( 'the_generator', 'strip_rss_version');
/*********************
WP_HEAD GOODNESS
The default wordpress head is a mess. Let's clean it up by
removing all the junk we don't need.
*********************/
function wusm_head_cleanup() {
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
	add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999);
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999);

	// Set default timezone
	update_option( 'timezone_string', 'America/Chicago' );
} /* end bones head cleanup */
// Remove WP version from scripts
function remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
// remove WP version from RSS
function strip_rss_version() { return ''; }

/**
 * Customize the footer in admin area
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
			'menu-item-object'	=> 'page',
			'menu-item-type'	=> 'post_type',
			'menu-item-status'	=> 'publish'
		);
		wp_update_nav_menu_item( $menu_id, 0, $menu_item );

		// Assign Header menu to the Header Menu theme location
		$locations = get_theme_mod('nav_menu_locations');
		$locations['header-menu'] = $menu_id;
		set_theme_mod('nav_menu_locations', $locations);
	}

	// Thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'landing-page', 1440, 9999 );
	add_image_size( 'faculty-list', 80, 112 );
	add_image_size( 'in-the-news', 340, 250 );
	add_image_size( 'spotlight-image', 157, 200 );
	add_image_size( 'outlook-thumb', 240, 220 );

	// Image sizes (Settings / Media)
	update_option('medium_size_w', 225);
	update_option('medium_size_h', NULL);
	update_option('large_size_w', 450);
	update_option('large_size_h', NULL);
	update_option('embed_size_w', 450);
	
	// Manual excerpts for pages as well as posts
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'theme_init' );

// Set default values for Attachment Display Settings
function attachment_display_settings() {
    update_option('image_default_align', 'center' );
    update_option('image_default_link_type', 'none' );
    update_option('image_default_size', 'large' );
}
add_action('after_setup_theme', 'attachment_display_settings');

function enable_editor_styles() {
	add_editor_style( '_/css/editor-style.css' );
}
add_action( 'init', 'enable_editor_styles' );

// Hide admin bar for subscribers. Probably won't be needed, but just in case.
function cc_hide_admin_bar() {
	if (!current_user_can('edit_posts')) {
		show_admin_bar(false);
	}
}
add_action('set_current_user', 'cc_hide_admin_bar');

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function page_by_name($page) {
	if (get_page_by_title( $page ) != NULL)
		return esc_url( get_permalink( get_page_by_title( $page ) ) );
	else
		return home_url();
}

function enqueue_styles() {
	wp_enqueue_style( 'reset-style', get_template_directory_uri() . '/_/css/reset.css' );
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
	
	if(is_front_page()) {
	?>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/_/css/nivo-slider.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/_/css/default/default.css" type="text/css" media="screen" />
	<?php
	}
}
add_action( 'wp_head', 'enqueue_styles' );

/*
 * Add "Clear" button to ACF Location fields
 */
if (is_admin()) {
	function tkes_acf_location_head() {
?>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('div.field_type-location-field').each(function(index) {
		var btn = jQuery('<button/>', {
			text: 'Clear',
			click: function() {
				var key = jQuery(this).data('key');
				jQuery('input#location_coordinates-address_fields_' + key).val('');
				jQuery('input#location_input_fields_' + key).val('');
				jQuery('dd#location_dd-address_fields_' + key).html('');
				jQuery('dd#location_dd-coordinates_fields_' + key).html('');
				location_init('fields_' + key);
				return false;
			},
			css: {
				'margin-left': '8px'
			},
			data: {
				'key': jQuery(this).data('field_key')
			}
		});
		jQuery(this).find('p.label label').append(btn);
	});
});
</script>
<?php
	}
	add_action('admin_head', 'tkes_acf_location_head');
}

// Customize the MCE editor
function customize_mce( $init ) {
	/* Register accordion styles */
	$style_formats = array(
		array(
			'title'	 => 'Main content callout',
			'block'	 => 'div',
			'classes' => 'callout',
			'wrapper' => true
		),
	);

	/* Only include your custom styles -- defined above -- in your style dropdown */
	$new = array_merge(json_decode($init['style_formats'], true), $style_formats);
	$init['style_formats'] = json_encode($new);
	return $init;
}
add_filter( 'tiny_mce_before_init', 'customize_mce' );

/*
 * Change [...] to MORE>> (w/ link)
 */
function new_excerpt_more( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">MORE»</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

/*
 * Limit search results to only posts and pages
 */
function searchfilter($query) {
	if ($query->is_search && !is_admin() ) {
		$query->set('post_type',array('page'));
	}
return $query;
}
add_filter('pre_get_posts','searchfilter');

function wp_query_posts_where( $where, &$wp_query ) {
	global $wpdb;
	if ( $post_title = $wp_query->get( 'post_title' ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $post_title ) ) . '%\'';
	}
	return $where;
}
add_filter( 'posts_where', 'wp_query_posts_where', 10, 2 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

// This comes from Otto
// https://core.trac.wordpress.org/ticket/11312#comment:6
function my_404_override() {
	global $wp_query;

	if ($wp_query->query_vars_changed) {
		status_header( 200 );
		$wp_query->is_404=false;
		$wp_query->is_search=true;
	}
}
add_filter('template_redirect', 'my_404_override' );

/*
 * Just leaving this here for later, I have a feeling we're going to need it
 */
// add tag support to pages
function tags_support_all() {
	register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
//add_action('init', 'tags_support_all');
//add_action('pre_get_posts', 'tags_support_query');

function change_bg($atts) {
	extract( shortcode_atts( array(
		'color' => 'f4f4f4'
	), $atts ) );

return "</article>
</div>
</div>
<div style='background: #$color;width: 100%;float: left;'>
<div class='wrapper'>
<article style='padding-left: 225px;padding-top: 24px;'>";
}
add_shortcode( 'change_background_to', 'change_bg' );

function tcb_add_tinymce_buttons( $tinyrowthree ) {
	$tinyrowthree[] = 'fontsizeselect';
	$tinyrowthree[] = 'hr';
	$tinyrowthree[] = 'sub';
	$tinyrowthree[] = 'sup';
	return $tinyrowthree;
}
add_filter( 'mce_buttons_3', 'tcb_add_tinymce_buttons' );