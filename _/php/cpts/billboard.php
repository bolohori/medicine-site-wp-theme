<?php
function create_billboard_post_type() {
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
}	
add_action( 'init', 'create_billboard_post_type' );

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

?>