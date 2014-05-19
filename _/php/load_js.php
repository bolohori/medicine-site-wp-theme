<?php 

function scripts() {
	wp_deregister_script('modernizr'); // deregister
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/_/js/modernizr.js', false, '2.7.1');

	wp_enqueue_script('custom_functions', get_template_directory_uri() . '/_/js/functions.js', array( 'jquery' ) );

    wp_enqueue_script('respond', get_template_directory_uri() . '/_/js/respond.min.js', array( 'jquery' ) );
}
add_action('wp_enqueue_scripts', 'scripts');