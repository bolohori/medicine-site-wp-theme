<?php

function create_custom_post_types() {
/*
 icons from http://www.iconarchive.com/show/web-icons-by-virtuallnk.html
 */
 
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
		'menu_icon' => 'dashicons-welcome-view-site',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/features' ),
		'capability_type' => 'post',
		'has_archive' => true, 
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
		'menu_icon' => 'dashicons-video-alt2',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/announcements' ),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'page-attributes')
	);

	register_post_type( 'announcement', $args );

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
		'menu_icon' => 'dashicons-list-view',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/releases' ),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array(
			'title',
			'editor',
			'revisions',
			'page-attributes',
		)
	);

	register_post_type( 'news_releases', $args );

	$labels = array(
		'name' => 'Media Mentions',
		'singular_name' => 'Media Mentions',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Media Mentions',
		'edit_item' => 'Edit Media Mentions',
		'new_item' => 'New Media Mentions',
		'all_items' => 'All Media Mentions',
		'view_item' => 'View Media Mentions',
		'search_items' => 'Search Media Mentions',
		'not_found' =>	'No Media Mentions found',
		'not_found_in_trash' => 'No Media Mentions found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Media Mentions'
	);

	$args = array(
		'labels' => $labels,
		'menu_icon' => 'dashicons-testimonial',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/press' ),
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'page-attributes')
	);

	register_post_type( 'media_mentions', $args );

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
		'menu_icon' => 'dashicons-chart-bar',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/headlines' ),
		'capability_type' => 'post',
		'has_archive' => true, 
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

	register_post_type( 'faculty', $args );

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
		'menu_icon' => 'dashicons-awards',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'about/faculty-recognition' ),
		'capability_type' => 'post',
		'has_archive' => true, 
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
		'menu_icon' => 'dashicons-businessman',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array( 'slug' => 'news/leaders' ),
		'capability_type' => 'post',
		'has_archive' => true, 
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
		'name' => 'Promoted Results',
		'singular_name' => 'Promoted Results',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Promoted Results',
		'edit_item' => 'Edit Promoted Results',
		'new_item' => 'New Promoted Results',
		'all_items' => 'All Promoted Results',
		'view_item' => 'View Promoted Results',
		'search_items' => 'Search Promoted Results',
		'not_found' =>	'No Promoted Results found',
		'not_found_in_trash' => 'No Promoted Results found in Trash', 
		'parent_item_colon' => '',
		'menu_name' => 'Promoted Results'
	);

	$args = array(
		'labels' => $labels,
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
		'menu_icon' => 'dashicons-feedback',
		'public' => true,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_position' => null,
		'rewrite' => array( 'slug' => 'news/in_the_news' ),
		/*'supports' => array(
			'title',			
		)*/
	); 

	register_post_type( 'in_the_news', $args );	

}	
add_action( 'init', 'create_custom_post_types' );

/*
 * To get permalinks to work when you activate the theme
 */
function rewrite_flush() {
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'rewrite_flush' );