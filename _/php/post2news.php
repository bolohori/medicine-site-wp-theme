<?php
function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News Articles';
	$submenu['edit.php'][5][0] = 'News Articles';
	$submenu['edit.php'][10][0] = 'Add News Article';
	$submenu['edit.php'][15][0] = 'Status'; // Change name for categories
	$submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
	echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );

function change_post_object_label() {
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
		$labels->name = 'News Articles';
		$labels->singular_name = 'News Article';
		$labels->add_new = 'Add News Article';
		$labels->add_new_item = 'Add News Article';
		$labels->edit_item = 'Edit News Article';
		$labels->new_item = 'News Article';
		$labels->view_item = 'View News Article';
		$labels->search_items = 'Search News Articles';
		$labels->not_found = 'No News Articles found';

		$labels->not_found_in_trash = 'No News Articles found in Trash';
}
add_action( 'init', 'change_post_object_label' );
function admin_bar_label( $wp_admin_bar ) {
	global $wp_admin_bar;
	$args = array(
		'id' => 'new-post', // id of the existing child node (New > Post)
		'title' => 'News Article' // alter the title of existing node
	);

	$wp_admin_bar->add_node($args);
	
}
add_action( 'admin_bar_menu', 'admin_bar_label', 999);
