<?php
// ***************************************
// Google Analytics template
// onclick="__gaTracker('send','event','outbound-<LABEL>','http://<URL OR LABEL>');"
// ***************************************


// Used on the front page to remove dimensions from billboard images
function remove_billboard_dimensions( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	return preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
}

if ( ! function_exists( 'feedburner_rss_redirect' ) ) {
	function feedburner_rss_redirect( $output, $feed ) {
		if ( strpos( $output, 'comments' ) )
			return $output;

		return esc_url( 'http://feeds.feedburner.com/WUSTL-Medicine-News/' );
	}
}
add_action( 'feed_link', 'feedburner_rss_redirect', 10, 2 );

if( ! defined('WP_LOCAL_INSTALL') ) { define( 'ACF_LITE', true ); require_once( get_template_directory() . '/_/php/acf_fields.php' ); }

require_once( get_template_directory() . '/_/php/faculty_profiles.php' );
require_once( get_template_directory() . '/_/php/custom_post_types.php' );
require_once( get_template_directory() . '/_/php/load_js.php' );
require_once( get_template_directory() . '/_/php/sidebar_helper.php' );

/*
 * Remove some of the unused stuff from the header
 */
if ( ! function_exists( 'medicine_head_cleanup' ) ) {
	function medicine_head_cleanup() {
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'start_post_rel_link' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );

		// Set default timezone
		update_option( 'timezone_string', 'America/Chicago' );
	}
}
add_action( 'init', 'medicine_head_cleanup' );

/*
 * Remove WP version from scripts
 */
if ( ! function_exists( 'medicine_remove_wp_ver_css_js' ) ) {
	function medicine_remove_wp_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
}
add_filter( 'style_loader_src', 'medicine_remove_wp_ver_css_js');
add_filter( 'script_loader_src', 'medicine_remove_wp_ver_css_js');

/*
 * remove WP version from RSS
 */
add_filter( 'the_generator', function() { return ''; });

/**
 * Customize the footer in admin area
 */
if ( ! function_exists( 'medicine_footer_admin' ) ) {
	function medicine_footer_admin () {
		echo 'Theme designed and developed by WUSTL Medical Public Affairs and powered by <a href="http://wordpress.org">WordPress</a>.';
	}
}
add_filter('admin_footer_text', 'medicine_footer_admin');

if( !defined( 'WP_LOCAL_INSTALL' ) ) {
	//check for Wash U IP
	$verifiedWashU = false;
	$IP = $_SERVER['REMOTE_ADDR'];
	list($ip1, $ip2) = explode( '.', $IP );

	if ( $ip1 == "128" && $ip2 == "252" ) {
		$verifiedWashU = true;
	} else if ( $ip1 == "172" && $ip2 == "20" ) {
		$verifiedWashU = true;
	} else if ( $ip1 == "172" && $ip2 == "18" ) {
		$verifiedWashU = true;
	} else if ( $ip1 == "10" && $ip2 == "39" ) {
		$verifiedWashU = true;
	} else if ( $ip1 == "10" && $ip2 == "30" ) {
		$verifiedWashU = true;
	} else if ( $ip1 == "10" && $ip2 == "40" ) {
		$verifiedWashU = true;
	} else if ( $ip1 == "10" && $ip2 == "27" ) {
		$verifiedWashU = true;
	} else if ( $ip1 == "10" && $ip2 == "21" ) {
		$verifiedWashU = true;
	}
} else {
	$verifiedWashU = true;
}
define( 'WASHU_IP', $verifiedWashU );

// Stylesheet for TinyMCE
add_editor_style( '_/css/editor-style.css' );

add_theme_support( 'post-thumbnails' );

// Thumbnails
add_image_size( 'landing-page', 1440, 9999, true );
add_image_size( 'faculty-list', 80, 112,true );
add_image_size( 'in-the-news', 340, 250, true );
add_image_size( 'spotlight-image', 143, 200, true );
add_image_size( 'outlook-thumb', 240, 9999, true );

// Image sizes (Settings / Media)
update_option('medium_size_w', 225);
update_option('medium_size_h', NULL);
update_option('large_size_w', 450);
update_option('large_size_h', NULL);
update_option('embed_size_w', 450);

// Manual excerpts for pages as well as posts
add_post_type_support( 'page', 'excerpt' );

/**
 * Intialize all the theme options
 */
if ( ! function_exists( 'medicine_theme_setup' ) ) {
	function medicine_theme_setup() {

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Create Header Menu theme location
		register_nav_menus( array( 
			'header-menu' => 'Header Menu',
			'mobile-menu' => 'Mobile Menu',
			'footer-menu' => 'Footer Menu'
		) );

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

			// Assign Header menu to the Header Menu theme location
			$locations = get_theme_mod('nav_menu_locations');
			$locations['header-menu'] = $menu_id;
			set_theme_mod('nav_menu_locations', $locations);
		}

		/*
		 * Set default values for Attachment Display Settings
		 */
		update_option('image_default_align', 'center' );
		update_option('image_default_link_type', 'none' );
		update_option('image_default_size', 'large' );
	}
}
add_action( 'after_setup_theme', 'medicine_theme_setup' );

/*
 * Hide admin bar for subscribers. This enables us to keep the site
 * hidden behind a WUSTL key login, but keeps the appearance consistant
 * with non-logged in "public" users (i.e. enables the "we need to
 * show the dean" functionality)
 */
if ( ! function_exists( 'medicine_hide_admin_bar' ) ) {
	function medicine_hide_admin_bar() {
		if (!current_user_can('edit_posts')) {
			show_admin_bar(false);
		}
	}
}
add_action('set_current_user', 'medicine_hide_admin_bar');

/*
 * Excerpt length as requested by the editors
 */
add_filter( 'excerpt_length', function() { return 20; }, 999 );

/*
 * Stylesheets, not really the traditional WordPress, but it works
 */
if ( ! function_exists( 'medicine_enqueue_styles' ) ) {
	function medicine_enqueue_styles() {
		/**
		 * The admin bar enqueues these two when a user is logged in, we need manually include
		 * them if they aren't logged in
		 */
		wp_deregister_style( 'open-sans' );
		wp_enqueue_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,700,800,600' );
		wp_dequeue_style( 'dashicons-css' );
		wp_enqueue_style( 'dashicons', '/wp-includes/css/dashicons.min.css' );

		wp_enqueue_style( 'reset', get_stylesheet_directory_uri(). '/_/css/reset.css' );
		wp_enqueue_style( 'medicine-style', get_stylesheet_uri() );
	}
}
add_action( 'wp_enqueue_scripts', 'medicine_enqueue_styles' );

/*
 * Add "Clear" button to ACF Location fields
 */
if ( is_admin() && !function_exists( 'medicine_acf_location_clear_button' )) {
	function medicine_acf_location_clear_button() {
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
}
add_action('admin_head', 'medicine_acf_location_clear_button');

// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'medicine_styles_dropdown' ) ) {
	function medicine_styles_dropdown( $settings ) {

		// Create array of new styles
		$new_styles = array(
			array(
				'title' => 'Signature',
				'items' => array(
					array(
						'title'		=> 'Name',
						'block'		=> 'p',
						'classes'	=> 'signature-name',
						'wrapper'	=> false
					),
					array(
						'title'		=> 'Title(s)',
						'block'		=> 'p',
						'classes'	=> 'signature-title',
						'wrapper'	=> false
					)
				)
			),
			array(
				'title'	=> 'Custom Styles',
				'items'	=> array(
					array(
						'title'		=> 'Intro Text',
						'block'		=> 'p',
						'classes'	=> 'intro-text',
						'wrapper'	=> false
					),
					array(
						'title'	   => 'Main content callout',
						'block'	   => 'div',
						'classes'  => 'callout',
						'wrapper'  => 'true'
					),
					array(
						'title'	   => 'Normal width (for full width pages)',
						'block'    => 'p',
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
						'title'	   => 'Signature block',
						'inline'   => 'span',
						'classes'  => 'signature-block'
					),
					array(
						'title'	   => 'Line height 16',
						'block'    => 'p',
						'selector' => 'p',
						'classes'  => 'line-height-16'
					),
					array(
						'title'	   => 'Line height 12',
						'block'    => 'p',
						'selector' => 'p',
						'classes'  => 'line-height-12'
					),
					array(
						'title'	   => 'Bulleted List (inside Main content callout)',
						'block'    => 'ul',
						'selector' => 'div > ul',
						'classes'  => 'bulleted-ul'
					),
				),
			),
		);

		// Merge old & new styles
		$settings['style_formats_merge'] = false;

		// Add new styles
		if( ! isset( $settings['style_formats'] ) ) {
			$settings['style_formats'] = json_encode( $new_styles );
		} else {
			$settings['style_formats'] = json_encode( array_merge( json_decode( $settings['style_formats'] ), $new_styles ) );
		}

		// Return New Settings
		return $settings;

	}
}
add_filter( 'tiny_mce_before_init', 'medicine_styles_dropdown' );

/*
 * Add call to action button to insert dropdown
 */
function medicine_button() {
	add_filter( "mce_external_plugins", "medicine_add_button" );
	add_filter( 'mce_buttons', 'medicine_register_button' );
}
function medicine_add_button( $plugin_array ) {
	$plugin_array['medicinebutton'] = get_template_directory_uri() . '/_/js/wusm-button.js';
	return $plugin_array;
}
function medicine_register_button( $buttons ) {
	if( ! in_array( 'medicinebutton', $buttons) ) {
		array_push( $buttons, 'medicinebutton' );
	}
	return $buttons;
}
add_action( 'admin_head', 'medicine_button' );

/*
 * Change [...] to MORE>> (w/ link)
 */
add_filter( 'excerpt_more', function() { return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">MORE»</a>'; } );

/*
 * Search post titles as well as content
 */
if ( ! function_exists( 'medicine_wp_query_posts_where' ) ) {
	function medicine_wp_query_posts_where( $where, &$wp_query ) {
		global $wpdb;
		if ( $post_title = $wp_query->get( 'post_title' ) ) {
			$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $post_title ) ) . '%\'';
		}
		return $where;
	}
}
add_filter( 'posts_where', 'medicine_wp_query_posts_where', 10, 2 );

/*
 * By default, WordPress throws a 404 if you try to paginate beyond
 * the number of pages it thinks it has.  We need to trick it since
 * we're adding the Google Search Appliance results
 * This comes from Otto
 * https://core.trac.wordpress.org/ticket/11312#comment:6
 *
 *  Had to change the filter hook to wp because Yoast's SEO
 *  plugin hooks in there to check pagination
 */
if ( ! function_exists( 'medicine_404_override' ) ) {
	function medicine_404_override() {
		global $wp_query;

		if ( isset( $wp_query->query_vars['search_terms_count'] ) ) {
			status_header( 200 );
			$wp_query->is_404=false;
			$wp_query->is_search=true;
		}
	}
}
add_filter('wp', 'medicine_404_override' );

/*
 * add tag support to pages
 */
add_action('init', function() { register_taxonomy_for_object_type('post_tag', 'page'); });

/*
 * ensure all tags are included in queries
 * THIS NEEDS SOME TESTING BEFORE GOING LIVE
 */ 
if ( ! function_exists( 'medicine_tags_support_query' ) ) {
	function medicine_tags_support_query($wp_query) {
		if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
	}
}
//add_action('pre_get_posts', 'medicine_tags_support_query');

/*
 * Shortcode to change the background, initially used for the admissions page, but
 * may be needed elsewhere
 */
if ( ! function_exists( 'medicine_change_bg' ) ) {
	function medicine_change_bg( $atts ) {
		extract( shortcode_atts( array(
			'color' => 'f4f4f4'
		), $atts ) );

	return "</article>
	</div>
	</div>
	<div style='background-color: #$color;width: 100%;float: left;border-top:1px solid #ddd'>
	<div class='wrapper'>
	<article style='background-color: #$color;padding-left: 225px;padding-top: 24px;'>";
	}
}
add_shortcode( 'change_background_to', 'medicine_change_bg' );

/*
 * Add extra buttons to TinyMCE
 */
if ( !function_exists( 'medicine_add_tinymce_buttons' ) ) {
	function medicine_add_tinymce_buttons( $tinyrowthree ) {
		$tinyrowthree[] = 'styleselect';
		$tinyrowthree[] = 'fontsizeselect';
		$tinyrowthree[] = 'visualblocks';
		return $tinyrowthree;
	}
}
add_filter( 'mce_buttons_3', 'medicine_add_tinymce_buttons' );

/* 
 * Customize mce editor font sizes
 */
if ( !function_exists( 'medicine_mce_text_sizes' ) ) {
	function medicine_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'medicine_mce_text_sizes' );

/*
/ Remove height and width attributes from images
 */
if ( ! function_exists( 'medicine_remove_dimensions' ) ) {
	function medicine_remove_dimensions( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		if( $size == 'landing-page' || $size == 'faculty-list' )
			return preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}
}
add_filter( 'post_thumbnail_html', 'medicine_remove_dimensions', 10, 5 );
// Don't need it in the content (?)
// add_filter( 'the_content', 'medicine_remove_dimensions', 10 );

/*
 * Remove extra 10px from width of wp-caption div
 * http://troychaplin.ca/2012/fix-automatically-generated-inline-style-on-wordpress-image-captions/
 */
if ( ! function_exists( 'medicine_fixed_img_caption_shortcode' ) ) {
	function medicine_fixed_img_caption_shortcode($attr, $content = null) {
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
}
add_shortcode('wp_caption', 'medicine_fixed_img_caption_shortcode');
add_shortcode('caption', 'medicine_fixed_img_caption_shortcode');

/*
 * Favicon on the admin side, just for fun
 */
if ( ! function_exists( 'medicine_admin_favicon' ) ) {
	function medicine_admin_favicon() {
		echo "<link rel='shortcut icon' href='" . get_stylesheet_directory_uri() . "/inc/img/favicon.ico' />";
	}
}
add_action('admin_head', 'medicine_admin_favicon');

/*
 * These are all the filters and function that work with the wusm-archives plugin
 * to create the custom post type archive pages
 */
add_filter( 'in_focus_link_text', 'in_focus_link_text_function', 10, 1 );
add_filter( 'in_focus_link_field', 'in_focus_link_url_function', 10, 1 );
add_filter( 'in_focus_thumbnail_size', function() { return array(320, 9999); } );
add_filter( 'in_focus_date_text', function() { return ''; } );
add_filter( 'in_focus_template_file', function() { return get_stylesheet_directory() . "/_/php/campus-life-template.php"; } );

add_filter( 'billboard_thumbnail_size', function() { return array( 700, 9999 ); } );
add_filter( 'billboard_link_field', function() { return 'link'; } );
add_filter( 'billboard_num_per_page', function() { return 9999; } );

add_filter( 'announcement_excerpt_text', function() { return ''; } );
add_filter( 'announcement_link_field', 'announcement_link_url_function', 10, 1 );

add_filter( 'news_releases_link_field', function() { return 'url'; } );

// SO meta!
add_filter( 'profile_excerpt_text', function() {
		add_filter( 'excerpt_more', function() { return '&hellip;'; }, 999 );
		add_filter( 'excerpt_length', function() { return 30; }, 999 );
		return get_the_excerpt();
});
add_filter( 'profile_template_file', function() { return get_stylesheet_directory() . "/_/php/profile-template.php"; } );
add_filter( 'profile_num_per_page', function() { return -1; }, 999 );
add_filter( 'profile_thumbnail_size', function() { return 'large'; }, 999 );

add_filter( 'media_mentions_link_field', function() { return 'url'; } );
add_filter( 'media_mentions_show_thumbnail', function() { return false; } );
add_filter( 'media_mentions_date_text', function() { return get_the_date("m/d/y") . " | " . get_field('source'); } );

//add_filter( 'spotlight_excerpt_text', function() { return ''; } );
add_filter( 'spotlight_show_thumbnail', function() { return false; } );
add_filter( 'spotlight_link_field', 'spotlight_link_url_function', 10, 1 );

if ( ! function_exists( 'spotlight_link_url_function' ) ) {
	function spotlight_link_url_function( $id ) {
		return ( $external_link = get_field( 'nl-link' ) ) ? 'nl-link' : '';
	}
}

if ( ! function_exists( 'in_focus_link_text_function' ) ) {
	function in_focus_link_text_function( $id ) {
		return ( $external_link = get_field( 'external_link' ) ) ? "<b>" . $external_link['title'] . "</b>" : '<b>See photos</b>';
	}
}

if ( ! function_exists( 'in_focus_link_url_function' ) ) {
	function in_focus_link_url_function( $id ) {
		return ( $external_link = get_field( 'external_link' ) ) ? 'external_link' : '';
	}
}

if ( ! function_exists( 'announcement_link_url_function' ) ) {
	function announcement_link_url_function( $id ) {
		return ( $external_link = get_field( 'url' ) ) ? 'url' : '';
	}
}

/*
 * Remove <p> tag from imgs
 * http://wordpress.stackexchange.com/questions/7090/stop-wordpress-wrapping-images-in-a-p-tag
 */
add_filter('the_content', function( $content ) { return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content); });
add_filter('acf/format_value_for_api/type=wysiwyg', function( $value ) { return preg_replace('/<p(.)*>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\2\3', $value); }, 10, 3);

add_filter( 'manage_billboard_posts_columns', 'column_heading', 11, 1 );
add_action( 'manage_billboard_posts_custom_column', 'column_content', 11, 2 );
add_filter( 'manage_announcement_posts_columns', 'column_heading', 11, 1 );
add_action( 'manage_announcement_posts_custom_column', 'column_content', 11, 2 );
//add_filter( 'manage_media_mentions_posts_columns', 'column_heading', 11, 1 );
//add_action( 'manage_media_mentions_posts_custom_column', 'column_content', 11, 2 );
function column_heading($columns) {
	unset($columns['wpseo-score']);
	unset($columns['wpseo-title']);
	unset($columns['wpseo-metadesc']);
	unset($columns['wpseo-focuskw']);
	$columns['sticky'] = 'Sticky';
	return $columns;
}

function column_content( $column_name, $post_id ) {
	if( $column_name === 'sticky' && get_post_meta( $post_id, 'sticky', true ) === '1') {
		echo '<div class="dashicons dashicons-yes"></div>';
	}
}

add_filter( 'wusm-maps_menu_position', function() { return 40; } );
add_filter( 'eventorganiser_menu_position', function() { return 50; } );
add_action( 'admin_menu', function() { remove_menu_page( 'edit.php' ); } );

function medicine_register_visualblocks() {
	$plugins = array('visualblocks'); //Add any more plugins you want to load here
	$plugins_array = array();

	//Build the response - the key is the plugin name, value is the URL to the plugin JS
	foreach ($plugins as $plugin ) {
		$plugins_array[ $plugin ] = get_stylesheet_directory_uri() . '/_/' . $plugin . '/plugin.js';
	}
	return $plugins_array;
}

add_filter('mce_external_plugins', 'medicine_register_visualblocks' );

function medicine_load_admin_style() {
	wp_enqueue_script( 'my-js', get_stylesheet_directory_uri() . '/_/js/acf-custom-admin.js', false );
}
add_action( 'admin_enqueue_scripts', 'medicine_load_admin_style' );

function medicine_search_filter( $query ) {
	$id = get_page_by_title( 'A to Z Index' );
	if ( $query->is_search && $query->is_main_query() ) {
		$query->set( 'post__not_in', array( $id->ID ) ); 
	}
}
add_filter( 'pre_get_posts', 'medicine_search_filter' );

function national_leaders_custom_rewrite_rules( $wp_rewrite ) {
	$my_rule = array( 'news/leaders/([^/]+)(/[0-9]+)?/?$' => 'index.php?pagename=$matches[1]&page=$matches[2]' );
	$wp_rewrite->rules = $my_rule + $wp_rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'national_leaders_custom_rewrite_rules' );




function get_top_parent_page_id() {
    global $post;
    $ancestors = $post->ancestors;
    // Check if page is a child page (any level)
    if ($ancestors) {
        //  Grab the ID of top-level page from the tree
        return end($ancestors);
    } else {
        // Page is the top level, so use  it's own id
        return $post->ID;
    }
}
