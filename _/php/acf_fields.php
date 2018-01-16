<?php

if ( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'    => 'Front Page',
		'menu_title'    => 'Front Page',
		'menu_slug'     => 'front-page',
		'capability'    => 'edit_users',
		'redirect'      => false,
		'parent'        => 'themes.php',
	));
	
	if ( function_exists( 'wusm_acf_admin_head' ) ) {
		add_action('acf/input/admin_head', 'wusm_acf_admin_head');
	}

}
