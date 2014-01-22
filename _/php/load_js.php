<?php 

function scripts() {
	if(is_page( 'maps' )) {
		wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false' );
		wp_enqueue_script( 'maps-js', get_stylesheet_directory_uri() . '/_/js/maps.js');
	}
	
	wp_deregister_script('modernizr'); // deregister
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/_/js/modernizr.js', false, '2.6.2');

	if(is_front_page()) {
		wp_enqueue_script('nivo_slider', get_stylesheet_directory_uri() . '/_/js/jquery.nivo.slider.pack.js', array( 'jquery' ) );
	}
	wp_enqueue_script('custom_functions', get_stylesheet_directory_uri() . '/_/js/functions.js', array( 'jquery' ) );

	if(is_post_type_archive( 'faculty_profile' )) {
		wp_enqueue_script( 'faculty-recognition', get_stylesheet_directory_uri() . '/_/js/faculty-recognition.js', array( 'jquery-effects-bounce' ) );
	}

	// embed the javascript file that makes the AJAX request
	wp_enqueue_script( 'my-ajax-request', get_stylesheet_directory_uri() . '/_/js/ajax-functions.js', array( 'jquery' ) );

	// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
	wp_localize_script( 'my-ajax-request', 'SOMAJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php', 'http' ) ) );
}
add_action('wp_enqueue_scripts', 'scripts');