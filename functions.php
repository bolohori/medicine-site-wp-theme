<?php
// ***************************************
// "OH SHIT" URL to reactivate twentyfourteen
// https://medicine-test.wustl.edu/wp-admin/themes.php?action=activate&stylesheet=twentyfourteen&_wpnonce=60fe37640f
// ***************************************

// ***************************************
// Google Analytics template
// onclick="javascript:_gaq.push(['_trackEvent','outbound-<LABEL>','http://<URL OR LABEL>']);"
// ***************************************

//add_action( 'init', 'github_updater_wusm_theme_init' );
if ( ! function_exists( 'github_updater_wusm_theme_init' ) ) {
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
}

if ( ! function_exists( 'feedburner_rss_redirect' ) ) {
	function feedburner_rss_redirect( $output, $feed ) {
		if ( strpos( $output, 'comments' ) )
			return $output;

		return esc_url( 'http://feeds.feedburner.com/WUSTL-Medicine-News/' );
	}
}
add_action( 'feed_link', 'feedburner_rss_redirect', 10, 2 );

if( ! defined('WP_LOCAL_INSTALL') ) { require_once( get_template_directory() . '/_/php/acf_fields.php' ); }

require_once( get_template_directory() . '/_/php/faculty_profiles.php' );
require_once( get_template_directory() . '/_/php/custom_post_types.php' );
require_once( get_template_directory() . '/_/php/load_js.php' );
require_once( get_template_directory() . '/_/php/sidebar_helper.php' );

/*
 * Remove some of the unused stuff from the header
 */
if ( ! function_exists( 'wusm_head_cleanup' ) ) {
	function wusm_head_cleanup() {
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
add_action( 'init', 'wusm_head_cleanup' );

/*
 * Remove WP version from scripts
 */
if ( ! function_exists( 'remove_wp_ver_css_js' ) ) {
	function remove_wp_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
}
add_filter( 'style_loader_src', 'remove_wp_ver_css_js');
add_filter( 'script_loader_src', 'remove_wp_ver_css_js');

/*
 * remove WP version from RSS
 */
add_filter( 'the_generator', function() { return ''; });

/**
 * Customize the footer in admin area
 */
if ( ! function_exists( 'wpfme_footer_admin' ) ) {
	function wpfme_footer_admin () {
		echo 'Theme designed and developed by WUSTL Medical Public Affairs and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
	}
}
add_filter('admin_footer_text', 'wpfme_footer_admin');

/**
 * Intialize all the theme options
 */
if ( ! function_exists( 'theme_init' ) ) {
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
	}
}
add_action( 'init', 'theme_init' );

/*
 * Set default values for Attachment Display Settings
 */
if ( ! function_exists( 'attachment_display_settings' ) ) {
	function attachment_display_settings() {
		update_option('image_default_align', 'center' );
		update_option('image_default_link_type', 'none' );
		update_option('image_default_size', 'large' );
	}
}
add_action('after_setup_theme', 'attachment_display_settings');


/*
 * Hide admin bar for subscribers. This enables us to keep the site
 * hidden behind a WUSTL key login, but keeps the appearance consistant
 * with non-logged in "public" users (i.e. enables the "we need to
 * show the dean" functionality)
 */
if ( ! function_exists( 'cc_hide_admin_bar' ) ) {
	function cc_hide_admin_bar() {
		if (!current_user_can('edit_posts')) {
			show_admin_bar(false);
		}
	}
}
add_action('set_current_user', 'cc_hide_admin_bar');

/*
 * Excerpt length as requested by the editors
 */
add_filter( 'excerpt_length', function() { return 20; }, 999 );

/*
 * Stylesheets, not really the traditional WordPress, but it works
 */
if ( ! function_exists( 'enqueue_wusm_styles' ) ) {
	function enqueue_wusm_styles() {
		wp_enqueue_style( 'reset-style', get_template_directory_uri() . '/_/css/reset.css' );
		wp_enqueue_style( 'main-style', get_template_directory_uri() . '/_/css/style.css' );
		
		if(is_front_page()) {
		?>
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/_/css/nivo-slider.css" type="text/css" media="screen" />
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/_/css/default/default.css" type="text/css" media="screen" />
		<?php
		}
	}
}
add_action( 'wp_head', 'enqueue_wusm_styles' );

/*
 * Add "Clear" button to ACF Location fields
 */
if ( is_admin() && !function_exists( 'acf_location_clear_button' )) {
	function acf_location_clear_button() {
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
add_action('admin_head', 'acf_location_clear_button');

// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'wusm_styles_dropdown' ) ) {
	function wusm_styles_dropdown( $settings ) {

		// Create array of new styles
		$new_styles = array(
			array(
				'title'	=> 'Custom Styles',
				'items'	=> array(
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
					)
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
add_filter( 'tiny_mce_before_init', 'wusm_styles_dropdown' );

/*
 * Change [...] to MORE>> (w/ link)
 */
add_filter( 'excerpt_more', function() { return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">MORE»</a>'; } );

/*
 * Search post titles as well as content
 */
if ( ! function_exists( 'wp_query_posts_where' ) ) {
	function wp_query_posts_where( $where, &$wp_query ) {
		global $wpdb;
		if ( $post_title = $wp_query->get( 'post_title' ) ) {
			$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( like_escape( $post_title ) ) . '%\'';
		}
		return $where;
	}
}
add_filter( 'posts_where', 'wp_query_posts_where', 10, 2 );

/*
 * By default, WordPress throws a 404 if you try to paginate beyond
 * the number of pages it thinks it has.  We need to trick it since
 * we're adding the Google Search Appliance results
 * This comes from Otto
 * https://core.trac.wordpress.org/ticket/11312#comment:6
 */
if ( ! function_exists( 'my_404_override' ) ) {
	function my_404_override() {
		global $wp_query;

		if ($wp_query->query_vars_changed) {
			status_header( 200 );
			$wp_query->is_404=false;
			$wp_query->is_search=true;
		}
	}
}
add_filter('template_redirect', 'my_404_override' );

/*
 * add tag support to pages
 */
add_action('init', function() { register_taxonomy_for_object_type('post_tag', 'page'); });

/*
 * ensure all tags are included in queries
 * THIS NEEDS SOME TESTING BEFORE GOING LIVE
 */ 
if ( ! function_exists( 'tags_support_query' ) ) {
	function tags_support_query($wp_query) {
		if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
	}
}
//add_action('pre_get_posts', 'tags_support_query');

/*
 * Shortcode to change the background, initially used for the admissions page, but
 * may be needed elsewhere
 */
if ( ! function_exists( 'wusm_change_bg' ) ) {
	function wusm_change_bg( $atts ) {
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
}
add_shortcode( 'change_background_to', 'wusm_change_bg' );

/*
 * Add extra buttons to TinyMCE
 */
if ( !function_exists( 'add_tinymce_buttons' ) ) {
	function add_tinymce_buttons( $tinyrowthree ) {
		$tinyrowthree[] = 'styleselect';
		$tinyrowthree[] = 'fontsizeselect';
		return $tinyrowthree;
	}
}
add_filter( 'mce_buttons_3', 'add_tinymce_buttons' );

/* 
 * Customize mce editor font sizes
 */
if ( !function_exists( 'wpex_mce_text_sizes' ) ) {
	function wpex_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );

/*
/ Remove height and width attributes from images
 */
if ( ! function_exists( 'remove_dimensions' ) ) {
	function remove_dimensions( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		if( $size == 'landing-page' || $size == 'faculty-list' )
			return preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}
}
add_filter( 'post_thumbnail_html', 'remove_dimensions', 10, 5 );
// Don't need it in the content (?)
// add_filter( 'the_content', 'remove_dimensions', 10 );

/*
 * Remove extra 10px from width of wp-caption div
 * http://troychaplin.ca/2012/fix-automatically-generated-inline-style-on-wordpress-image-captions/
 */
if ( ! function_exists( 'fixed_img_caption_shortcode' ) ) {
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
}
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');

/*
 * Favicon on the admin side, just for fun
 */
if ( ! function_exists( 'admin_favicon' ) ) {
	function admin_favicon() {
		echo "<link rel='shortcut icon' href='" . get_stylesheet_directory_uri() . "/inc/img/favicon.ico' />";
	}
}
add_action('admin_head', 'admin_favicon');

/*
 * These are all the filters and function that work with the wusm-archives plugin
 * to create the custom post type archive pages
 */
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

/*
....::::::::,.................................,,:::::::.....
....::?IIIIII?+=~::::::::::::::::::::::::::~=??IIIII+::.....
....::?IIIIIII:IIIIIIIIIIIIIIIIIIIIIIIIIIIIII=IIIIII+::.....
....::?III?:::::::IIIIIIIIIII:+7IIIIIIIII?:::::::III+::.....
....::?IIIII~:::?IIIIIIIIII?::::IIIIIIIIIII~:::+IIII+::.....
....:::=I77IIIIIIIIIIIIIIII++II:?IIIIIIIIIIIIIII77?=:::.....
....:::::::::::::::~~==+++++++++++==~~~::::::::::::::::.....
....:::::::::::::::::::::::::::::::::::::::::::::::::::.....
....:::::::::::::7:,IIIIIIIIIIIIIIIIII7::7:::::::::::::.....
....::?IIIII77+,?7::IIIIIIIIIIIIIIIIII7::77,~777IIII+::.....
....::?IIIIIII+,?7::IIIIIIIIIIIIIIIIII7::77,~IIIIIII+::.....
....::?IIIIIII+,?7::IIIIIIIIIIIIIIIIII7::77,~IIIIIII+::.....
....:::::,:=+?+,?7:,IIIIIIIIIIIIIIIIII7::77,~+~:,,:::::.....
....:::::::::::,?7:::::::::,=7?,:::::::::77,:::::::::::.....
....:::::::::::,I7777777777II~II77777777777,:::::::::::.....
....::++=:::::::::::::::::::,=,:::::::::::::::::::~++::.....
....::?IIIIIII~II7777II??++++=++++??II7777III=IIIIII+::.....
....::?IIIIII+:?IIIIIIIIIIII?:~IIIIIIIIIIIII=:+IIIII+::.....
....::=III=I:+~~?=IIIIIIIIII?::IIIIIIIIII?+:+=+++?II~:,.....
.....:::III?,+~~:IIIIIII::::?=?~::::IIIIIII,+=+,II?::,......
.......,:::?II:IIIIIIIIIIII?=+I:?IIIIIIIIIIII~II:::.........
............:::::+IIIIIIII?:=+I::IIIIIIII?:::::.............
.................,:::::?IIII?:~IIII?~::::...................
........................,:::::::::,.........................
............................................................

01010111 01100001 01110011 01101000 01101001 01101110 01100111 01110100 01101111 01101110  01010101 01101110 01101001 01110110 01100101 01110010 01110011 01101001 01110100 01111001 
01010011 01100011 01101000 01101111 01101111 01101100  01101111 01100110  01001101 01100101 01100100 01101001 01100011 01101001 01101110 01100101                                    
01101001 01101110  01010011 01110100 00101110  01001100 01101111 01110101 01101001 01110011                                                                                          

*/