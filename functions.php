<?php

/*
 * Feedburner Redirect.
 */

if ( ! function_exists( 'feedburner_rss_redirect' ) ) {
	function feedburner_rss_redirect( $output, $feed ) {
		if ( strpos( $output, 'comments' ) ) {
			return $output;
		}

		return esc_url( 'http://feeds.feedburner.com/WUSTL-Medicine-News/' );
	}
}
add_action( 'feed_link', 'feedburner_rss_redirect', 10, 2 );

/*
 * Billboard Space.
 */

add_action(
	'acf/include_field_types', function() {
		include_once( get_template_directory() . '/_/php/acf_fields.php' );
	}, 20
);

require_once( get_template_directory() . '/_/php/faculty_profiles.php' );
require_once( get_template_directory() . '/_/php/custom_post_types.php' );
require_once( get_template_directory() . '/_/php/load_js.php' );
require_once( get_template_directory() . '/_/php/sidebar_helper.php' );

function move_news_type_rewrites( $rules ) {

	$news_rules = array();

	foreach ( $rules as $rule => $rewrite ) {

		if ( preg_match( '/^news.*/', $rule ) ) {

			$news_rules[ $rule ] = $rules[ $rule ];
			unset( $rules[ $rule ] );
		}
	}

	return array_merge( $rules, $news_rules );
}
add_filter( 'rewrite_rules_array', 'move_news_type_rewrites' );

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
		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}
		return $src;
	}
}
add_filter( 'style_loader_src', 'medicine_remove_wp_ver_css_js' );
add_filter( 'script_loader_src', 'medicine_remove_wp_ver_css_js' );

/*
 * remove WP version from RSS
 */
add_filter(
	'the_generator', function() {
		return '';
	}
);

/**
 * Customize the footer in admin area
 */
if ( ! function_exists( 'medicine_footer_admin' ) ) {
	function medicine_footer_admin() {
		echo 'Theme designed and developed by WUSTL Medical Public Affairs and powered by <a href="http://wordpress.org">WordPress</a>.';
	}
}
add_filter( 'admin_footer_text', 'medicine_footer_admin' );

if ( ! defined( 'WP_DEBUG' ) || WP_DEBUG == false ) {
	//check for Wash U IP
	$verifiedWashU = false;

	if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ) {
		$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$IP_array = explode( ',', $IP );
		$IP = $IP_array[0];
	} else {
		$IP = $_SERVER['REMOTE_ADDR'];
	}

	list($ip1, $ip2) = explode( '.', $IP );

	if ( $ip1 == '128' && $ip2 == '252' ) {
		$verifiedWashU = true;
	} else if ( $ip1 == '172' && $ip2 == '20' ) {
		$verifiedWashU = true;
	} else if ( $ip1 == '172' && $ip2 == '18' ) {
		$verifiedWashU = true;
	} else if ( $ip1 == '10' && $ip2 == '39' ) {
		$verifiedWashU = true;
	} else if ( $ip1 == '10' && $ip2 == '30' ) {
		$verifiedWashU = true;
	} else if ( $ip1 == '10' && $ip2 == '40' ) {
		$verifiedWashU = true;
	} else if ( $ip1 == '10' && $ip2 == '27' ) {
		$verifiedWashU = true;
	} else if ( $ip1 == '10' && $ip2 == '21' ) {
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
add_image_size( 'headshot', 250, 345, true );
add_image_size( 'news', 600, 441, true ); // Used on cards
add_image_size( 'news-email', 600, 9999 );

// Image sizes (Settings / Media)
update_option( 'medium_size_w', 300 );
update_option( 'medium_size_h', null );
update_option( 'large_size_w', 700 );
update_option( 'large_size_h', null );
update_option( 'embed_size_w', 645 );

// Add headshot to image size dropdown
function wusm_image_size_choose( $sizes ) {
	$new_list = array_diff( $sizes, array( 'thumbnail' => 'Thumbnail' ) );
	$custom_sizes = array(
		'headshot' => 'Headshot',
	);
	$new_list = array_merge( $new_list, $custom_sizes );
	return $new_list;
}
add_filter( 'image_size_names_choose', 'wusm_image_size_choose' );

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
		register_nav_menus(
			array(
				'header-menu' => 'Header Menu',
				'mobile-menu' => 'Mobile Menu',
				'footer-menu' => 'Footer Menu',
			)
		);

		/*
		 * Set default values for Attachment Display Settings
		 */
		update_option( 'image_default_align', 'none' );
		update_option( 'image_default_link_type', 'none' );
		update_option( 'image_default_size', 'large' );
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

		if ( ! current_user_can( 'edit_posts' ) ) {

			show_admin_bar( false );

		}

	}
}
add_action( 'set_current_user', 'medicine_hide_admin_bar' );

/*
 * Excerpt length as requested by the editors
 */
add_filter(
	'excerpt_length', function() {
		return 20;
	}, 999
);

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
		wp_enqueue_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,700,800,600|Open+Sans+Condensed:700' );
		wp_dequeue_style( 'dashicons-css' );
		wp_enqueue_style( 'dashicons', '/wp-includes/css/dashicons.min.css' );
		wp_enqueue_style( 'reset', get_stylesheet_directory_uri() . '/_/css/reset.css' );
		wp_enqueue_style( 'medicine-style', get_stylesheet_uri() );

	}
}
add_action( 'wp_enqueue_scripts', 'medicine_enqueue_styles' );


/*
 * Switch "Posts" to "News"
 */
function wusm_change_post_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'News';
	echo '';
}
function wusm_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add Article';
	$labels->add_new_item = 'Add News Article';
	$labels->edit_item = 'Edit News Article';
	$labels->new_item = 'News';
	$labels->view_item = 'View Article';
	$labels->search_items = 'Search Articles';
	$labels->not_found = 'No articles found';
	$labels->not_found_in_trash = 'No articles found in Trash';
	$labels->all_items = 'All Articles';
	$labels->menu_name = 'News';
	$labels->name_admin_bar = 'Article';
}
add_action( 'admin_menu', 'wusm_change_post_label' );
add_action( 'init', 'wusm_change_post_object' );


/*
 * Add "Clear" button to ACF Location fields
 */
if ( is_admin() && ! function_exists( 'medicine_acf_location_clear_button' ) ) {
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
add_action( 'admin_head', 'medicine_acf_location_clear_button' );

// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'medicine_styles_dropdown' ) ) {
	function medicine_styles_dropdown( $settings ) {

		// Create array of new styles
		$new_styles = array(
			array(
				'title' => 'Signature',
				'items' => array(
					array(
						'title'     => 'Name',
						'block'     => 'p',
						'classes'   => 'signature-name',
						'wrapper'   => false,
					),
					array(
						'title'     => 'Title(s)',
						'block'     => 'p',
						'classes'   => 'signature-title',
						'wrapper'   => false,
					),
				),
			),
			array(
				'title' => 'Custom Styles',
				'items' => array(
					array(
						'title'     => 'Intro Text',
						'block'     => 'p',
						'classes'   => 'intro-text',
						'wrapper'   => false,
					),
					array(
						'title'    => 'Callout',
						'block'    => 'div',
						'classes'  => 'callout',
						'wrapper'  => true,
					),
					array(
						'title'    => 'Related Content',
						'block'    => 'div',
						'classes'  => 'related-content',
						'wrapper'  => true,
					),
					array(
						'title'    => 'Name',
						'block'    => 'p',
						'classes'  => 'name',
						'wrapper'  => false,
					),
					array(
						'title'    => 'Disclaimer',
						'block'    => 'div',
						'classes'  => 'disclaimer',
						'wrapper'  => true,
					),
				),
			),
		);

		// Merge old & new styles
		$settings['style_formats_merge'] = false;

		// Add new styles
		if ( ! isset( $settings['style_formats'] ) ) {
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
	add_filter( 'mce_external_plugins', 'medicine_add_button' );
	add_filter( 'mce_buttons', 'medicine_register_button' );
}
function medicine_add_button( $plugin_array ) {
	$plugin_array['medicinebutton'] = get_template_directory_uri() . '/_/js/wusm-button.js';
	return $plugin_array;
}
function medicine_register_button( $buttons ) {
	if ( ! in_array( 'medicinebutton', $buttons ) ) {
		array_push( $buttons, 'medicinebutton' );
	}
	return $buttons;
}
add_action( 'admin_head', 'medicine_button' );

/*
 * Change [...] to MORE>> (w/ link)
 */
add_filter(
	'excerpt_more', function() {
		return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">MORE»</a>';
	}
);


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
			$wp_query->is_404 = false;
			$wp_query->is_search = true;
		}
	}
}
add_filter( 'wp', 'medicine_404_override' );

/*
 * add tag support to pages
 */
add_action(
	'init', function() {
		register_taxonomy_for_object_type( 'post_tag', 'page' );
	}
);

/*
 * ensure all tags are included in queries
 * THIS NEEDS SOME TESTING BEFORE GOING LIVE
 */
if ( ! function_exists( 'medicine_tags_support_query' ) ) {
	function medicine_tags_support_query( $wp_query ) {
		if ( $wp_query->get( 'tag' ) ) {
			$wp_query->set( 'post_type', 'any' );
		}
	}
}
//add_action('pre_get_posts', 'medicine_tags_support_query');



/*
 * Shortcode to change the background, initially used for the admissions page, but
 * may be needed elsewhere
 */
if ( ! function_exists( 'medicine_change_bg' ) ) {
	function medicine_change_bg( $atts ) {
		extract(
			shortcode_atts(
				array(
					'color' => 'f4f4f4',
				), $atts
			)
		);

		return "</article>
	</div>
	</div>
	<div class='clearfix' style='background-color: #$color;width: 100%;border-top:1px solid #ddd'>
	<div class='wrapper'>
	<article class='giving-bottom' style='background-color: #$color;padding-top: 24px;'>";
	}
}
add_shortcode( 'change_background_to', 'medicine_change_bg' );

/*
 * Add extra buttons to TinyMCE
 */
if ( ! function_exists( 'medicine_add_tinymce_buttons' ) ) {
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
if ( ! function_exists( 'medicine_mce_text_sizes' ) ) {
	function medicine_mce_text_sizes( $initArray ) {
		$initArray['fontsize_formats'] = '9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px';
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'medicine_mce_text_sizes' );

/*
/ Remove height and width attributes from images
 */
if ( ! function_exists( 'medicine_remove_dimensions' ) ) {
	function medicine_remove_dimensions( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		if ( $size == 'landing-page' ) {
			return preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );
		}
		return $html;
	}
}
add_filter( 'post_thumbnail_html', 'medicine_remove_dimensions', 10, 5 );

/*
 * Remove extra 10px from width of wp-caption div
 * http://troychaplin.ca/2012/fix-automatically-generated-inline-style-on-wordpress-image-captions/
 */
// Remove height from [caption] shortcode
function medicine_caption_shortcode_filter( $val, $attr, $content ) {
	extract(
		shortcode_atts(
			array(
				'id'    => '',
				'align' => '',
				'width' => '',
				'caption' => '',
			), $attr
		)
	);

	if ( 1 > (int) $width || empty( $caption ) ) {
		return $val;
	}

	$imageID = $int = filter_var( $id, FILTER_SANITIZE_NUMBER_INT );
	$creditName = esc_html( get_post_meta( $imageID, 'image_credit', true ) );
	if ( ! empty( $creditName ) ) {
		$credit = '<span class="image-credit">' . $creditName . '</span>';
	}

	$capid = '';
	if ( $id ) {
		$id = esc_attr( $id );
		$capid = 'id="figcaption_' . $id . '" ';
		$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
	}

	$maxWidth = '';
	$captionAlign = esc_attr( $align );
	if ( $captionAlign == 'alignleft' || $captionAlign == 'alignright' ) {
		$maxWidth = 'style="max-width: ' . ( 0 + (int) $width ) . 'px;"';
	}

	$captionOutput = '<div class="wp-caption ' . $captionAlign . '"' . $maxWidth . '>';
	if ( ! empty( $creditName ) ) {
		$captionOutput .= '<div class="credit-container">';
	}
	$captionOutput .= do_shortcode( $content );
	if ( ! empty( $creditName ) ) {
		$captionOutput .= $credit . '</div>';
	}
	$captionOutput .= '<div ' . $capid . 'class="wp-caption-text"' . $maxWidth . '>' . $caption . '</div></div>';

	return $captionOutput;
}
add_filter( 'img_caption_shortcode', 'medicine_caption_shortcode_filter', 10, 3 );

/*
 * Favicon on the admin side, just for fun
 */
if ( ! function_exists( 'medicine_admin_favicon' ) ) {
	function medicine_admin_favicon() {
		echo "<link rel='shortcut icon' href='" . get_stylesheet_directory_uri() . "/inc/img/favicon.ico' />";
	}
}
add_action( 'admin_head', 'medicine_admin_favicon' );

/*
 * These are all the filters and function that work with the wusm-archives plugin
 * to create the custom post type archive pages
 */
add_filter( 'campus-life_link_text', 'campus_life_link_text_function', 10, 1 );
add_filter( 'campus-life_link_field', 'campus_life_link_url_function', 10, 1 );
add_filter(
	'campus-life_thumbnail_size', function() {
		return array( 320, 9999 );
	}
);
add_filter(
	'campus-life_date_text', function() {
		return '';
	}
);
add_filter(
	'campus-life_template_file', function() {
		return get_stylesheet_directory() . '/_/php/campus-life-template.php';
	}
);

add_filter(
	'announcement_excerpt_text', function() {
		return '';
	}
);
add_filter( 'announcement_link_field', 'announcement_link_url_function', 10, 1 );

add_filter( 'news-release_link_field', 'news_release_link_url_function', 10, 1 );

// SO meta!
add_filter(
	'profiles_excerpt_text', function() {
		add_filter(
			'excerpt_more', function() {
				return '&hellip;';
			}, 999
		);
		add_filter(
			'excerpt_length', function() {
				return 30;
			}, 999
		);
		return get_the_excerpt();
	}
);
add_filter(
	'profiles_template_file', function() {
		return get_stylesheet_directory() . '/_/php/profiles-template.php';
	}
);
add_filter(
	'profiles_num_per_page', function() {
		return -1;
	}, 999
);
add_filter(
	'profiles_thumbnail_size', function() {
		return 'large';
	}, 999
);

add_filter(
	'in-the-media_link_field', function() {
		return 'url';
	}
);
add_filter(
	'in-the-media_show_thumbnail', function() {
		return false;
	}
);
add_filter(
	'in-the-media_date_text', function() {
		return get_the_date( 'm/d/y' ) . ' | ' . get_field( 'source' );
	}
);

add_filter(
	'national-leader_show_thumbnail', function() {
		return false;
	}
);
add_filter( 'national-leader_link_field', 'spotlight_link_url_function', 10, 1 );

add_filter(
	'washington-people_link_field', function() {
		return 'url';
	}
);
add_filter(
	'washington-people_thumbnail_size', function() {
		return 'large';
	}, 999
);

add_filter(
	'outlook_link_field', function() {
		return 'url';
	}
);
add_filter(
	'outlook_thumbnail_size', function() {
		return 'large';
	}, 999
);

if ( ! function_exists( 'spotlight_link_url_function' ) ) {
	function spotlight_link_url_function( $id ) {
		return ( $external_link = get_field( 'url' ) ) ? 'url' : '';
	}
}

if ( ! function_exists( 'campus_life_link_text_function' ) ) {
	function campus_life_link_text_function( $id ) {
		return '<b>See photos</b>';
	}
}

if ( ! function_exists( 'campus_life_link_url_function' ) ) {
	function campus_life_link_url_function( $id ) {
		return ( $external_link = get_field( 'url' ) ) ? 'url' : '';
	}
}

if ( ! function_exists( 'announcement_link_url_function' ) ) {
	function announcement_link_url_function( $id ) {
		return ( $external_link = get_field( 'url' ) ) ? 'url' : '';
	}
}

if ( ! function_exists( 'news_release_link_url_function' ) ) {
	function news_release_link_url_function( $id ) {
		return ( $external_link = get_field( 'url' ) ) ? 'url' : '';
	}
}

/*
 * Remove <p> tag from imgs
 * http://wordpress.stackexchange.com/questions/7090/stop-wordpress-wrapping-images-in-a-p-tag
 */
add_filter(
	'the_content', function( $content ) {
		return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	}
);
add_filter(
	'acf/format_value_for_api/type=wysiwyg', function( $value ) {
		return preg_replace( '/<p(.)*>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\2\3', $value );
	}, 10, 3
);

add_filter( 'manage_billboard_posts_columns', 'column_heading', 11, 1 );
add_action( 'manage_billboard_posts_custom_column', 'column_content', 11, 2 );
add_filter( 'manage_announcement_posts_columns', 'column_heading', 11, 1 );
add_action( 'manage_announcement_posts_custom_column', 'column_content', 11, 2 );
function column_heading( $columns ) {
	unset( $columns['wpseo-score'] );
	unset( $columns['wpseo-title'] );
	unset( $columns['wpseo-metadesc'] );
	unset( $columns['wpseo-focuskw'] );
	$columns['sticky'] = 'Sticky';
	return $columns;
}

function column_content( $column_name, $post_id ) {
	if ( $column_name === 'sticky' && get_post_meta( $post_id, 'sticky', true ) === '1' ) {
		echo '<div class="dashicons dashicons-yes"></div>';
	}
}

add_filter(
	'wusm-maps_menu_position', function() {
		return 40;
	}
);
add_filter(
	'eventorganiser_menu_position', function() {
		return 50;
	}
);

function medicine_register_visualblocks() {
	$plugins = array( 'visualblocks' ); //Add any more plugins you want to load here
	$plugins_array = array();

	//Build the response - the key is the plugin name, value is the URL to the plugin JS
	foreach ( $plugins as $plugin ) {
		$plugins_array[ $plugin ] = get_stylesheet_directory_uri() . '/_/' . $plugin . '/plugin.js';
	}
	return $plugins_array;
}

add_filter( 'mce_external_plugins', 'medicine_register_visualblocks' );

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

function get_top_parent_page_id() {
	global $post;
	$ancestors = $post->ancestors;
	// Check if page is a child page (any level)
	if ( $ancestors ) {
		//  Grab the ID of top-level page from the tree
		return end( $ancestors );
	} else {
		// Page is the top level, so use  it's own id
		return $post->ID;
	}
}


// NEWS
// Add Phone Number to User Profiles
function new_contactmethods( $contactmethods ) {
	$contactmethods['phone'] = 'Phone Number'; // Add Phone Number
	$contactmethods['title'] = 'Title'; // Add Phone Number

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'new_contactmethods', 10, 1 );

function modify_archive_query( $query ) {
	if ( is_category() || is_tax( 'news' ) || is_author() ) {
		$query->set( 'posts_per_page', 24 ); // Show 24 posts per page on archive pages
	}

	if ( $query->is_main_query() && is_author() ) {
			// Author archive pages
			$author = get_user_by( 'slug', $query->get( 'author_name' ) );

			$query->set( 'post_type', 'post' );
			$query->set(
				'meta_query', array(
					'relation'      => 'OR',
					array(
						'key'       => 'article_author_%_author',
						'compare'   => '=',
						'value'     => $author->ID,
					),
					array(
						'key'       => 'multimedia_producer_%_producer',
						'compare'   => '=',
						'value'     => $author->ID,
					),
				)
			);

			// Without this, "AND ([db_prefix]_posts.post_author = [$author->ID])" is included in the WHERE clause of the query
			unset( $query->query_vars['author_name'] );
	}
}
add_action( 'pre_get_posts', 'modify_archive_query' );

function author_archive_where( $where ) {
	$where = str_replace( "meta_key = 'article_author_", "meta_key LIKE 'article_author_", $where );
	$where = str_replace( "meta_key = 'multimedia_producer_", "meta_key LIKE 'multimedia_producer_", $where );

	return $where;
}
add_filter( 'posts_where', 'author_archive_where' );

function author_archive_title() {
	global $wp_query;
	if ( $wp_query->is_main_query() && is_author() ) {
		// Author archive pages
		$curauth = get_user_by( 'slug', $wp_query->query['author_name'] );
		return $curauth->display_name . ' | ' . get_bloginfo( 'name' );
	}
}
add_filter( 'pre_get_document_title', 'author_archive_title', 100, 0 );

// Add field for photo credits
function add_image_credit( $form_fields, $post ) {
	$form_fields['credit'] = array(
		'label' => 'Credit',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'image_credit', true ),
	);

	return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'add_image_credit', 10, 2 );

// Save field for photo credits
function image_credit_save( $post, $attachment ) {
	if ( isset( $attachment['credit'] ) ) {
		update_post_meta( $post['ID'], 'image_credit', $attachment['credit'] );
	}

	return $post;
}
add_filter( 'attachment_fields_to_save', 'image_credit_save', 10, 2 );

// Add image credits to images without captions
function ic_wrap_image( $content ) {
	if ( is_single() && ! get_query_var( 'template' ) == 'email' ) {
		global $post;
		// Regex to find all <img ... > tags
		$ic_url_regex = '/\<img [^>]*src="([^"]+)"[^>]*>/';

		// If we get any hits then put the code before and after the img tags
		if ( preg_match_all( $ic_url_regex, $content, $ic_matches ) ) {
			;
			for ( $ic_count = 0; $ic_count < count( $ic_matches[0] ); $ic_count++ ) {
				// Old img tag
				$ic_old = $ic_matches[0][ $ic_count ];
				if ( strpos( $ic_old, 'align' ) ) {

					if ( preg_match( '/wp-image-([0-9]+)/', $ic_old, $found ) ) {
						$creditID = $found[1];
					}

					if ( preg_match( '/align(\w+)/', $ic_old, $found ) ) {
						$alignment = $found[0];
					}

					$creditName = esc_html( get_post_meta( $creditID, 'image_credit', true ) );
					if ( ! empty( $creditName ) ) {
						$credit = '<span class="image-credit">' . $creditName . '</span>';
					}

					// Get the img URL, it's needed for the button code
					$ic_img_url = preg_replace( '/^.*src="/', '', $ic_old );
					$ic_img_url = preg_replace( '/".*$/', '', $ic_img_url );

					// Put together the image credit code to place before the img tag
					$ic_credit_code = '<span class="credit-container ' . $alignment . '">';

					if ( ! empty( $creditName ) ) {
						// Replace before the img tag in the new string
						$ic_new = preg_replace( '/^/', $ic_credit_code, $ic_old );
						// After the img tag
						$ic_new = preg_replace( '/$/', $credit . '</span>', $ic_new );
					} else {
						$ic_new = $ic_old;
					}

					// make the substitution
					$content = str_replace( $ic_old, $ic_new, $content );
				}
			}
		}
	}
	return $content;
}
add_filter( 'the_content', 'ic_wrap_image' );

// Customize the_archive_title used in archive.php
add_filter(
	'get_the_archive_title', function ( $title ) {
		if ( is_category( 'editors-picks' ) ) {
			$title = single_cat_title( '', false );
		} elseif ( is_category() ) {
			$title = single_cat_title( 'Topic: ', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( 'Tag: ', false );
		} elseif ( is_tax( 'news' ) ) {
			$title = single_tag_title( 'News Source: ', false );
		}
		return $title;
	}
);

// Remove Jetpack Sharing from excerpt
function wusm_remove_share() {
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( get_query_var( 'template' ) == 'email' ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
	}
}
add_action( 'loop_start', 'wusm_remove_share' );

// Remove Jetpack Related Posts from bottom of the_content.
// They're displayed farther down on the page using a shortcode.
function jetpackme_remove_rp() {
	if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
		$jprp = Jetpack_RelatedPosts::init();
		$callback = array( $jprp, 'filter_add_target_to_dom' );
		remove_filter( 'the_content', $callback, 40 );
	}
}
add_filter( 'wp', 'jetpackme_remove_rp', 20 );

// Set height of boilerplate field on news stories
function admin_css() {
?>
	<style>
	.acf-field-56393793048a5 iframe {
		height: 200px!important;
	}
	</style>
<?php
}
add_action( 'admin_head', 'admin_css' );

// Preview URLs for embargoed articles will expire after 24 days
function wusm_preview_nonce_life() {
	return 60 * 60 * 24 * 30; // 30 days
}
add_filter( 'ppp_nonce_life', 'wusm_preview_nonce_life' );

// NEWS RELEASE EMAIL
// Add query var for email template
function wusm_register_query_var( $vars ) {
	$vars[] = 'template';
	return $vars;
}
add_filter( 'query_vars', 'wusm_register_query_var' );

// Switch to email template if query var is present in URL
function wusm_url_rewrite_template() {
	if ( get_query_var( 'template' ) == 'email' ) {
		add_filter(
			'template_include', function() {
				return get_template_directory() . '/_/php/news/email.php';
			}
		);
	}
}
add_action( 'template_redirect', 'wusm_url_rewrite_template' );

// Add am/pm and timezone when displaying times in Publish box on backend. This is important for embargoed news posts.
function format_publish_box_date( $translated_text, $untranslated_text, $domain ) {

	$date_format = 'M j, Y @ H:i'; // From wp-admin/includes/meta-boxes.php

	if ( is_admin() && $untranslated_text === $date_format ) {
		return 'M j, Y @ g:i a T';
	}

	return $translated_text;
}
add_filter( 'gettext', 'format_publish_box_date', 20, 3 );

/*
 * Podcast Section!
 */

// Change number of episodes in feed to 50.
add_filter( 'ssp_feed_number_of_posts', 'ssp_modify_number_of_posts_in_feed' );
function ssp_modify_number_of_posts_in_feed( $n ) {
	return 50;
}

// Remove size of episode.
add_filter( 'ssp_episode_meta_details', 'ssp_remove_download_link', 10, 3 );
function ssp_remove_download_link( $meta, $episode_id, $context ) {
	unset( $meta['size'] );
	return $meta;
}

// Remove default player.
add_filter( 'ssp_show_media_player', '__return_false' );

remove_shortcode( 'wusm_archive' );
add_shortcode( 'wusm_archive', function() { return false; } );
