<?php 

function scripts() {
	wp_deregister_script('modernizr'); // deregister
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/_/js/modernizr.js', false, '2.6.2');

	wp_enqueue_script('custom_functions', get_template_directory_uri() . '/_/js/functions.js', array( 'jquery' ) );
}
add_action('wp_enqueue_scripts', 'scripts');