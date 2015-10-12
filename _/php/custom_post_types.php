<?php
function create_custom_post_types() {

	$labels = array(
		'name'               => 'Profiles',
		'singular_name'      => 'Profile',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Profile',
		'edit_item'          => 'Edit Profile',
		'new_item'           => 'New Profile',
		'all_items'          => 'All Profiles',
		'view_item'          => 'View Profile',
		'search_items'       => 'Search Profiles',
		'not_found'          =>	'No Profiles found',
		'not_found_in_trash' => 'No Profiles found in Trash', 
		'parent_item_colon'  => '',
		'menu_name'          => 'Profiles'
	);
	$args = array(
		'labels'              => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus'   => false,
		'menu_icon'           => 'dashicons-nametag',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true, 
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'about/people' ),
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
			'excerpt'
		)
	);
	register_post_type( 'profile', $args );

	$labels = array(
		'name'               => 'In the Media',
		'singular_name'      => 'In the Media',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New In the Media',
		'edit_item'          => 'Edit In the Media',
		'new_item'           => 'New In the Media',
		'all_items'          => 'All In the Media',
		'view_item'          => 'View In the Media',
		'search_items'       => 'Search In the Media',
		'not_found'          =>	'No In the Media found',
		'not_found_in_trash' => 'No In the Media found in Trash', 
		'parent_item_colon'  => '',
		'menu_name'          => 'In the Media'
	);
	$args = array(
		'labels'              => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus'   => false,
		'menu_icon'           => 'dashicons-testimonial',
		'public'              => false,
		'publicly_queryable'  => true,
		'show_ui'             => true, 
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'news/in-the-media' ),
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_position'       => null,
		'supports'            => array('title', 'page-attributes', 'thumbnail')
	);
	register_post_type( 'media_mentions', $args );

	$labels = array(
		'name'               => 'In The News',
		'singular_name'      => 'In The News',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New In The News',
		'edit_item'          => 'Edit In The News',
		'new_item'           => 'New In The News',
		'all_items'          => 'All In The News',
		'view_item'          => 'View In The News',
		'search_items'       => 'Search In The News',
		'not_found'          =>	'No In The News found',
		'not_found_in_trash' => 'No In The News found in Trash', 
		'parent_item_colon'  => '',
		'menu_name'          => 'In The News'
	);
	$args = array(
		'labels'              => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus'   => false,
		'has_archive'         => true,
		'menu_icon'           => 'dashicons-feedback',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true, 
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'news/in-the-news' ),
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_position'       => 5,
	);
	register_post_type( 'in_the_news', $args );

	$labels = array(
		'name'               => 'Announcements',
		'singular_name'      => 'Announcement',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Announcement',
		'edit_item'          => 'Edit Announcement',
		'new_item'           => 'New Announcement',
		'all_items'          => 'All Announcements',
		'view_item'          => 'View Announcement',
		'search_items'       => 'Search Announcements',
		'not_found'          =>	'No announcements found',
		'not_found_in_trash' => 'No announcements found in Trash', 
		'parent_item_colon'  => '',
		'menu_name'          => 'Announcements'
	);
	$args = array(
		'labels'              => $labels,
		'exclude_from_search' => true,
		'show_in_nav_menus'   => false,
		'menu_icon'           => 'dashicons-video-alt2',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true, 
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'news/announcements' ),
		'capability_type'     => 'post',
		'hierarchical'        => true,
		'menu_position'       => null,
		'supports'            => array('title', 'page-attributes', 'editor', 'excerpt')
	);
	register_post_type( 'announcement', $args );

	$labels = array(
		'name'               => 'Search Results',
		'singular_name'      => 'Search Results',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Search Results',
		'edit_item'          => 'Edit Search Results',
		'new_item'           => 'New Search Results',
		'all_items'          => 'All Search Results',
		'view_item'          => 'View Search Results',
		'search_items'       => 'Search Search Results',
		'not_found'          =>	'No Search Results found',
		'not_found_in_trash' => 'No Search Results found in Trash', 
		'parent_item_colon'  => '',
		'menu_name'          => 'Search Results'
	);
	$args = array(
		'labels'             => $labels,
		'show_in_nav_menus'  => false,
		'menu_icon'          => 'dashicons-search',
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true, 
		'show_in_menu'       => true, 
		'query_var'          => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
	); 
	register_post_type( 'promoted_results', $args );

	$labels = array(
		'name'               => 'Faculty Recognition',
		'singular_name'      => 'Faculty Recognition',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Faculty Recognition',
		'edit_item'          => 'Edit Faculty Recognition',
		'new_item'           => 'New Faculty Recognition',
		'all_items'          => 'All Faculty Recognitions',
		'view_item'          => 'View Faculty Recognition',
		'search_items'       => 'Search Faculty Recognitions',
		'not_found'          =>	'No Faculty Recognitions found',
		'not_found_in_trash' => 'No Faculty Recognitions found in Trash', 
		'parent_item_colon'  => '',
		'menu_name'          => 'Faculty Recognition'
	);
	$args = array(
		'labels'             => $labels,
		'show_in_nav_menus'  => false,
		'menu_icon'          => 'dashicons-awards',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true, 
		'show_in_menu'       => true, 
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'about/faculty-recognition' ),
		'capability_type'    => 'post',
		'hierarchical'       => true,
		'menu_position'      => null,
		'taxonomies'         => array( 'category', 'post_tag' ),
		'supports'           => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
			'page-attributes',
		)
	); 
	register_post_type( 'faculty_profile', $args );

	$labels = array(
		'name'               => 'Faculty Member',
		'singular_name'      => 'Faculty Members',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Faculty Member',
		'edit_item'          => 'Edit Faculty Member',
		'new_item'           => 'New Faculty Member',
		'all_items'          => 'All Faculty Members',
		'view_item'          => 'View Faculty Member',
		'search_items'       => 'Search Faculty Members',
		'not_found'          =>	'No Faculty Members found',
		'not_found_in_trash' => 'No Faculty Members found in Trash', 
		'parent_item_colon'  => '',
		'menu_name'          => 'Faculty Members'
	);
	$args = array(
		'labels'             => $labels,
		'show_in_nav_menus'  => false,
		'menu_icon'          => 'dashicons-groups',
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true, 
		'show_in_menu'       => true, 
		'query_var'          => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes',
		)
	);
	/*
	 * Hold on this until v2.0
	 */
	//register_post_type( 'faculty', $args );


	/**
	 * Custom Taxonomies associated with news stories
	 */
	$labels = array(
		'name'					=> 'News Types',
		'singular_name'			=> 'News Type',
		'search_items'			=> 'Search News Types',
		'popular_items'			=> 'Popular News Types',
		'all_items'				=> 'All News Types',
		'parent_item'			=> 'Parent News Type',
		'parent_item_colon'		=> 'Parent News Type',
		'edit_item'				=> 'Edit News Type',
		'update_item'			=> 'Update News Type',
		'add_new_item'			=> 'Add New News Type',
		'new_item_name'			=> 'New News Type Name',
		'add_or_remove_items'	=> 'Add or remove News Types',
		'choose_from_most_used'	=> 'Choose from most used text-domain',
		'menu_name'				=> 'News Type',
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);
	
	register_taxonomy( 'news', array( 'post' ), $args );

	$labels = array(
		'name'              => 'Research News Expertise',
		'singular_name'     => 'Research News Expertise',
		'search_items'      => 'Search Research News Expertise',
		'all_items'         => 'All Research News Expertise',
		'parent_item'       => 'Parent Research News Expertise',
		'parent_item_colon' => 'Parent Research News Expertise:',
		'edit_item'         => 'Edit Research News Expertise',
		'update_item'       => 'Update Research News Expertise',
		'add_new_item'      => 'Add New Research News Expertise',
		'new_item_name'     => 'New Research News Expertise',
		'menu_name'         => 'Research News Expertise',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'public'            => false,
		'rewrite'           => false,
		'show_admin_column' => false,
		'query_var'         => true,
	);

	register_taxonomy( 'expertise', array( 'research_news', 'post' ), $args );
	/**
	 * End custom taxonomies associated with news stories
	 */

}	
add_action( 'init', 'create_custom_post_types' );

/*
 * To get permalinks to work when you activate the theme
 */
function rewrite_flush() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rewrite_flush' );


function add_announcement_settings () { add_submenu_page( 'edit.php?post_type=announcement', 'announcement settings', 'Settings', 'manage_categories', 'announcement-settings', 'announcement_settings_callback' ); }
add_action( 'admin_menu', 'add_announcement_settings' );

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

function add_billboard_settings () { add_submenu_page( 'edit.php?post_type=billboard', 'Billboard settings', 'Settings', 'manage_categories', 'billboard-settings', 'billboard_settings_callback' ); }
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