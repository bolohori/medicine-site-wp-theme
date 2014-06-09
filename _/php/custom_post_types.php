<?php
function create_custom_post_types() {
	$labels = array(
		'name' => 'News Releases',
		'singular_name' => 'News Releases',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New News Releases',
		'edit_item' => 'Edit News Releases',
		'new_item' => 'New News Releases',
		'all_items' => 'All News Releases',
		'view_item' => 'View News Releases',
		'search_items' => 'Search News Releases',
		'not_found' =>	'No news Releases found',
		'not_found_in_trash' => 'No News Releases found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'News Releases'
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-list-view',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/releases' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'page-attributes',
			'excerpt'
		)
	);
	register_post_type( 'news_releases', $args );

	$labels = array(
		'name' => 'Press',
		'singular_name' => 'Press',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Press',
		'edit_item' => 'Edit Press',
		'new_item' => 'New Press',
		'all_items' => 'All Press',
		'view_item' => 'View Press',
		'search_items' => 'Search Press',
		'not_found' =>	'No Press found',
		'not_found_in_trash' => 'No Press found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Press'
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-testimonial',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/press' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'page-attributes')
	);
	register_post_type( 'media_mentions', $args );

	$labels = array(
		'name' => 'In The News',
		'singular_name' => 'In The News',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New In The News',
		'edit_item' => 'Edit In The News',
		'new_item' => 'New In The News',
		'all_items' => 'All In The News',
		'view_item' => 'View In The News',
		'search_items' => 'Search In The News',
		'not_found' =>	'No In The News found',
		'not_found_in_trash' => 'No In The News found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'In The News'
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-feedback',
		'public' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/in-the-news' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => false,
		'menu_position' => null,
		/*'supports' => array('title', 'page-attributes')*/
	);
	register_post_type( 'in_the_news', $args );

	$labels = array(
		'name' => 'Billboards',
		'singular_name' => 'Billboard',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Billboard',
		'edit_item' => 'Edit Billboard',
		'new_item' => 'New Billboard',
		'all_items' => 'All Billboards',
		'view_item' => 'View Billboard',
		'search_items' => 'Search Billboards',
		'not_found' =>	'No billboards found',
		'not_found_in_trash' => 'No billboards found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Billboards'
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-welcome-view-site',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/features' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'page-attributes', 'thumbnail' )
	); 
	register_post_type( 'billboard', $args );

	$labels = array(
		'name' => 'Announcements',
		'singular_name' => 'Announcement',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Announcement',
		'edit_item' => 'Edit Announcement',
		'new_item' => 'New Announcement',
		'all_items' => 'All Announcements',
		'view_item' => 'View Announcement',
		'search_items' => 'Search Announcements',
		'not_found' =>	'No announcements found',
		'not_found_in_trash' => 'No announcements found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Announcements'
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-video-alt2',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/announcements' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'page-attributes', 'editor', 'excerpt')
	);
	register_post_type( 'announcement', $args );

	$labels = array(
		'name' => 'National Leaders',
		'singular_name' => 'National Leader',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New National Leader',
		'edit_item' => 'Edit National Leader',
		'new_item' => 'New National Leader',
		'all_items' => 'All National Leaders',
		'view_item' => 'View National Leader',
		'search_items' => 'Search National Leaders',
		'not_found' =>	'No National Leaders found',
		'not_found_in_trash' => 'No National Leaders found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'National Leaders'
	);
	$args = array(
		'labels' => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-businessman',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/leaders' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
		)
	); 
	register_post_type( 'spotlight', $args );

	$labels = array(
		'name' => 'Research News',
		'singular_name' => 'Research News Story',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Research News Story',
		'edit_item' => 'Edit Research News Story',
		'new_item' => 'New Research News Story',
		'all_items' => 'All Research News Stories',
		'view_item' => 'View Research News Story',
		'search_items' => 'Search Research News Stories',
		'not_found' =>	'No research news stories found',
		'not_found_in_trash' => 'No research news stories found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Research News'
	);
	$args = array(
		'labels' => $labels,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-chart-bar',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/headlines' ),
		'capability_type' => 'post',
		'taxonomies' => array( 'category' ),
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'revisions',
			'page-attributes',
		)
	); 
	register_post_type( 'research_news', $args );

	$labels = array(
		'name' => 'In Focus',
		'singular_name' => 'In Focus',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New In Focus',
		'edit_item' => 'Edit In Focus',
		'new_item' => 'New In Focus',
		'all_items' => 'All In Focuss',
		'view_item' => 'View In Focus',
		'search_items' => 'Search In Focuses',
		'not_found' =>	'No In Focuses found',
		'not_found_in_trash' => 'No In Focuses found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'In Focus'
	);
	$args = array(
		'labels' => $labels,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-slides',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/in-focus' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
			'excerpt'
		)
	); 
	register_post_type( 'in_focus', $args );

	$labels = array(
		'name' => 'Search Results',
		'singular_name' => 'Search Results',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Search Results',
		'edit_item' => 'Edit Search Results',
		'new_item' => 'New Search Results',
		'all_items' => 'All Search Results',
		'view_item' => 'View Search Results',
		'search_items' => 'Search Search Results',
		'not_found' =>	'No Search Results found',
		'not_found_in_trash' => 'No Search Results found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Search Results'
	);
	$args = array(
		'labels' => $labels,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-search',
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_position' => null,
		/*'supports' => array(
			'title',			
		)*/
	); 
	register_post_type( 'promoted_results', $args );

	$labels = array(
		'name' => 'Faculty Recognition',
		'singular_name' => 'Faculty Recognition',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Faculty Recognition',
		'edit_item' => 'Edit Faculty Recognition',
		'new_item' => 'New Faculty Recognition',
		'all_items' => 'All Faculty Recognitions',
		'view_item' => 'View Faculty Recognition',
		'search_items' => 'Search Faculty Recognitions',
		'not_found' =>	'No Faculty Recognitions found',
		'not_found_in_trash' => 'No Faculty Recognitions found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Faculty Recognition'
	);
	$args = array(
		'labels' => $labels,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-awards',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'about/faculty-recognition' ),
		'capability_type' => 'post',
		/*'has_archive' => true, */
		'hierarchical' => true,
		'menu_position' => null,
		'taxonomies' => array( 'category', 'post_tag' ),
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
		)
	); 
	register_post_type( 'faculty_profile', $args );

	$labels = array(
		'name' => 'Faculty Member',
		'singular_name' => 'Faculty Members',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Faculty Member',
		'edit_item' => 'Edit Faculty Member',
		'new_item' => 'New Faculty Member',
		'all_items' => 'All Faculty Members',
		'view_item' => 'View Faculty Member',
		'search_items' => 'Search Faculty Members',
		'not_found' =>	'No Faculty Members found',
		'not_found_in_trash' => 'No Faculty Members found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Faculty Members'
	);
	$args = array(
		'labels' => $labels,
		'show_in_nav_menus' => false,
		'menu_icon' => 'dashicons-groups',
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
		)
	);
	//register_post_type( 'faculty', $args );
}	
add_action( 'init', 'create_custom_post_types' );

/*
 * To get permalinks to work when you activate the theme
 */
function rewrite_flush() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rewrite_flush' );


function add_announcement_settings () { add_submenu_page( 'edit.php?post_type=announcement', 'announcement settings', 'Settings', 'manage_options', 'announcement-settings', 'announcement_settings_callback' ); }
add_action( 'admin_menu', 'add_announcement_settings' );

function add_spotlight_settings () { add_submenu_page( 'edit.php?post_type=spotlight', 'spotlight settings', 'Settings', 'manage_options', 'spotlight-settings', 'spotlight_settings_callback' ); }
add_action( 'admin_menu', 'add_spotlight_settings' );

function announcement_settings_callback() { ?>
	<div class="wrap">
	<h2>Announcement Settings</h2>
		<table class="form-table">
		<tbody>
		<tr valign="top">
		<th scope="row"><label for="announcements">Number of announcements to display</label></th>
		<td><input id="announcements" type="number" name="announcements" min="1" max="100" value="<?php echo get_option( 'announcements_to_show', 6 ); ?>">
		</tr>
		</tbody></table>
		<?php submit_button( 'Save Setting', 'primary', 'announcements-save', true, array( 'id' => 'announcements-save' ) );?>
	</div>
<?php }

function spotlight_settings_callback() { ?>
	<div class="wrap">
	<h2>National Leaders</h2>
		<table class="form-table">
		<tbody>
		<tr valign="top">
		<th scope="row"><label for="spotlights">Number of National Leaders to display</label></th>
		<td><input id="spotlights" type="number" name="spotlights" min="1" max="100" value="<?php echo get_option( 'spotlights_to_show', 4 ); ?>">
		</tr>
		</tbody></table>
		<?php submit_button( 'Save Setting', 'primary', 'spotlights-save', true, array( 'id' => 'spotlights-save' ) );?>
		
	</div>
<?php }

function update_announcements_javascript() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	$("#announcements-save").click(function(e) {
		e.preventDefault();
		announcements = $("#announcements").val();

		var data = {
			action: 'update_announcements',
			num_to_show: announcements
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(ajaxurl, data, function(response) {
			if(response == false)
				alert('There was an error updating the setting.');
			else
				alert('Setting saved.');
		});
	});
});
</script>
<?php
}
add_action( 'admin_footer', 'update_announcements_javascript' );

function update_announcements_callback() {
	global $wpdb; // this is how you get access to the database
	$num_to_show = $_POST['num_to_show'];
	echo $num_to_show . " : " . update_option( 'announcements_to_show', $num_to_show );
	die(); // this is required to return a proper result
}
add_action('wp_ajax_update_announcements', 'update_announcements_callback');

function update_spotlights_javascript() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	$("#spotlights-save").click(function(e) {
		e.preventDefault();
		spotlights = $("#spotlights").val();

		var data = {
			action: 'update_spotlights',
			num_to_show: spotlights
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(ajaxurl, data, function(response) {
			if(response == false)
				alert('There was an error updating the setting.');
			else
				alert('Setting saved.');
		});
	});
});
</script>
<?php
}
add_action( 'admin_footer', 'update_spotlights_javascript' );

function update_spotlights_callback() {
	global $wpdb; // this is how you get access to the database
	$num_to_show = $_POST['num_to_show'];
	echo $num_to_show . " : " . update_option( 'spotlights_to_show', $num_to_show );
	die(); // this is required to return a proper result
}
add_action('wp_ajax_update_spotlights', 'update_spotlights_callback');

function add_billboard_settings () { add_submenu_page( 'edit.php?post_type=billboard', 'Billboard settings', 'Settings', 'manage_options', 'billboard-settings', 'billboard_settings_callback' ); }
add_action( 'admin_menu', 'add_billboard_settings' );

function billboard_settings_callback() { ?>
	<div class="wrap">
	<h2>Billboard Settings</h2>
		<table class="form-table">
		<tbody>
		<tr valign="top">
		<th scope="row"><label for="billboards">Number of Billboards to display</label></th>
		<td><input id="billboards" type="number" name="billboards" min="1" max="10" value="<?php echo get_option( 'billboards_to_show', 5 ); ?>">
		</tr>
		</tbody></table>
		<p>
		<?php submit_button( 'Save Setting', 'primary', 'billboards-save', false, array( 'id' => 'billboards-save', 'style' => 'float:left; margin-right: 20px;' ) );?><span class="spinner" style="float: left;"></span>
		</p>
	</div>
<?php }

function update_billboards_javascript() { ?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	$("#billboards-save").click(function(e) {
		e.preventDefault();
		$(".spinner").show();
		billboards = $("#billboards").val();

		var data = {
			action: 'update_billboards',
			num_to_show: billboards
		};

		$.post(ajaxurl, data, function(response) {
			$(".spinner").hide();
		});
	});
});
</script>
<?php
}
add_action( 'admin_footer', 'update_billboards_javascript' );

function update_billboards_callback() {
	global $wpdb; // this is how you get access to the database
	$num_to_show = $_POST['num_to_show'];
	update_option( 'billboards_to_show', $num_to_show );
	die(); // this is required to return a proper result
}
add_action('wp_ajax_update_billboards', 'update_billboards_callback');