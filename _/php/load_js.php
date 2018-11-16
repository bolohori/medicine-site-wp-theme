<?php
function queue_wusm_scripts() {
	wp_deregister_script('modernizr'); // deregister
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/_/js/modernizr.js', false, '2.6.2');

	wp_register_script('wusm-fitvids', get_template_directory_uri() . '/_/js/jquery.fitvids.min.js', array( 'jquery' ), '1.1', true );

	wp_enqueue_script('custom_functions', get_stylesheet_directory_uri() . '/_/js/functions.js', array( 'jquery' ) );

	wp_localize_script( 'custom_functions', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    wp_enqueue_script('match_height', get_stylesheet_directory_uri() . '/_/js/jquery.matchHeight-min.js', array( 'jquery' ) );

	if ( is_front_page() ) {
		wp_enqueue_script('lity', get_stylesheet_directory_uri() . '/_/js/lity.min.js', array( 'jquery' ) );
	}
}

add_action('wp_enqueue_scripts', 'queue_wusm_scripts');
