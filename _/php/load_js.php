<?php 
/*
 * Enqueue KineticJS and Circles for the front page menu
 */
function scripts() {
	wp_deregister_script('modernizr'); // deregister
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/_/js/modernizr-2.6.2.dev.js', false, '2.6.2');

	wp_enqueue_script('custom_functions', get_stylesheet_directory_uri() . '/_/js/functions.js', array( 'jquery' ) );
}
add_action('wp_enqueue_scripts', 'scripts');
?>