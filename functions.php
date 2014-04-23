<?php
// ***************************************
// "OH SHIT" URL to reactivate twentyfourteen
// https://medicine-test.wustl.edu/wp-admin/themes.php?action=activate&stylesheet=twentyfourteen&_wpnonce=60fe37640f
// ***************************************

// ***************************************
// Google Analytics template
// onclick="javascript:_gaq.push(['_trackEvent','outbound-<LABEL>','http://<URL OR LABEL>']);"
// ***************************************

//add_action( 'admin_init', 'hide_admin_extras' );
function hide_admin_extras() {
	if( ! in_array( 'acf_5443' , $current = get_user_meta( get_current_user_id(), 'metaboxhidden_page' ) ) ) {
		$current[] = 'acf_5443';
		get_user_meta( get_current_user_id(), 'metaboxhidden_page',  $current);
	}
}

//add_action( 'init', 'github_updater_wusm_theme_init' );
function github_updater_wusm_theme_init() {

	if( ! class_exists( 'WP_GitHub_Updater' ) )
		include_once 'updater.php';

	if( ! defined( 'WP_GITHUB_FORCE_UPDATE' ) )
		define( 'WP_GITHUB_FORCE_UPDATE', true );

	if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
		
		$config = array(
				'id' => 0,
				'slug' => plugin_basename( __FILE__ ),
				'plugin' => plugin_basename(__FILE__),
				'proper_folder_name' => 'medicine',
				'api_url' => 'https://api.github.com/repos/coderaaron/medicine',
				'raw_url' => 'https://raw.github.com/coderaaron/medicine/master',
				'github_url' => 'https://github.com/coderaaron/medicine',
				'zip_url' => 'https://github.com/coderaaron/medicine/archive/master.zip',
				'sslverify' => true,
				'requires' => '3.0',
				'tested' => '3.9',
				'readme' => 'README.md',
				'access_token' => '',
		);

		new WP_GitHub_Updater( $config );
	}
}

if( ! defined('WP_LOCAL_INSTALL') ) {
	require_once( get_template_directory() . '/_/php/acf_fields.php' );
}

require_once( get_template_directory() . '/_/php/faculty_profiles.php' );
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
	register_nav_menus( array( 
		'header-menu' => 'Header Menu',
		'footer-menu' => 'Footer Menu',
		'sticky-footer-menu' => 'Sticky Footer Menu'
	) );

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
		//$page = get_page_by_title('Sample Page');
		/*$menu_item = array(
			'menu-item-object-id' => $page->ID,
			'menu-item-object'	=> 'page',
			'menu-item-type'	=> 'post_type',
			'menu-item-status'	=> 'publish'
		);*/
		//wp_update_nav_menu_item( $menu_id, 0, $menu_item );

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
	add_image_size( 'spotlight-image', 147, 200, true );
	add_image_size( 'outlook-thumb', 240, 9999 );

	// Image sizes (Settings / Media)
	update_option('medium_size_w', 225);
	update_option('medium_size_h', NULL);
	update_option('large_size_w', 450);
	update_option('large_size_h', NULL);
	update_option('embed_size_w', 450);
	
	// Manual excerpts for pages as well as posts
	add_post_type_support( 'page', 'excerpt' );

	if(!defined('WP_LOCAL_INSTALL')) {
		//check for Wash U IP
		$verifiedWashU = false;
		$IP = $_SERVER['REMOTE_ADDR'];
		list($ip1, $ip2) = explode('.', $IP);

		if ($ip1 == "128" && $ip2 == "252") {
			$verifiedWashU = true;
		} else if ($ip1 == "172" && $ip2 == "20") {
			$verifiedWashU = true;
		} else if ($ip1 == "172" && $ip2 == "18") {
			$verifiedWashU = true;
		} else if ($ip1 == "10" && $ip2 == "39") {
			$verifiedWashU = true;
		} else if ($ip1 == "10" && $ip2 == "30") {
			$verifiedWashU = true;
		} else if ($ip1 == "10" && $ip2 == "40") {
			$verifiedWashU = true;
		} else if ($ip1 == "10" && $ip2 == "27") {
			$verifiedWashU = true;
		} else if ($ip1 == "10" && $ip2 == "21") {
			$verifiedWashU = true;
		}
	} else {
		$verifiedWashU = true;
	}
	define('WASHU_IP', $verifiedWashU);
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
			'title'	  => 'Main content callout',
			'block'	  => 'div',
			'classes' => 'callout',
			'wrapper' => 'true'
		),
		array(
			'title'	   => 'Normal width (for full width pages)',
			'selector' => 'p',
			'classes'  => 'normal-width',
		),
		array(
			'title'    => 'Disclaimer',
			'block'    => 'div',
			'classes'  => 'disclaimer',
			'wrapper'  => 'true'
		),
		array(
			'title'    => 'Line height 16',
			'block'    => 'p',
			'classes'  => 'line-height-16',
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
//add_filter('pre_get_posts','searchfilter');

function wp_query_posts_where( $where, &$wp_query ) {
	global $wpdb;
	if ( $post_title = $wp_query->get( 'post_title' ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $post_title ) ) . '%\'';
	}
	return $where;
}
add_filter( 'posts_where', 'wp_query_posts_where', 10, 2 );

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

// Remove height and width attributes from images so that we can make them responsive
function remove_dimensions( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	if( $size == 'landing-page' || $size == 'faculty-list' )
		return preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_dimensions', 10, 5 );
//add_filter( 'the_content', 'remove_dimensions', 10 );


// Remove extra 10px from width of wp-caption div
// http://troychaplin.ca/2012/fix-automatically-generated-inline-style-on-wordpress-image-captions/
function fixed_img_caption_shortcode($attr, $content = null) {
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;
	extract(shortcode_atts(array(
		'id'    => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));
	if ( 1 > (int) $width || empty($caption) )
		return $content;
	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');

function admin_favicon() {
	echo "<link rel='shortcut icon' href='" . get_stylesheet_directory_uri() . "/inc/img/favicon.ico' />";
}
add_action('admin_head', 'admin_favicon');

add_filter( 'in_focus_link_text', 'in_focus_link_text_function', 10, 1 );
add_filter( 'in_focus_link_field', 'in_focus_link_url_function', 10, 1 );
add_filter( 'in_focus_thumbnail_size', function() { return array(320, 9999); } );
add_filter( 'in_focus_date_text', function() { return ''; } );
add_filter( 'billboard_thumbnail_size', function() { return array( 700, 9999 ); } );
add_filter( 'billboard_link_field', function() { return 'link'; } );
add_filter( 'announcement_excerpt_text', function() { return ''; } );
add_filter( 'announcement_link_field', 'announcement_link_url_function', 10, 1 );
add_filter( 'news_releases_link_field', function() { return 'url'; } );
add_filter( 'media_mentions_link_field', function() { return 'url'; } );
add_filter( 'spotlight_excerpt_text', function() { return ''; } );

function in_focus_link_text_function( $id ) {
	return ( $external_link = get_field( 'external_link' ) ) ? "<b>" . $external_link['title'] . "</b>" : '<b>See photos</b>';
}

function in_focus_link_url_function( $id ) {
	return ( $external_link = get_field( 'external_link' ) ) ? 'external_link' : '';
}

function announcement_link_url_function( $id ) {
	return ( $external_link = get_field( 'url' ) ) ? 'url' : '';
}

// Remove <p> tag from imgs
// http://wordpress.stackexchange.com/questions/7090/stop-wordpress-wrapping-images-in-a-p-tag
add_filter('the_content', function( $content ) { return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content); });
add_filter('acf/format_value_for_api/type=wysiwyg', function( $value ) { return preg_replace('/<p(.)*>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\2\3', $value); }, 10, 3);
