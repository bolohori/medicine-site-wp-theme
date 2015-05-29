<?php 
function queue_wusm_scripts() {
	wp_deregister_script('modernizr'); // deregister
	wp_enqueue_script('modernizr', get_stylesheet_directory_uri() . '/_/js/modernizr.js', false, '2.6.2');

	if(is_front_page()) {
		wp_enqueue_script('bxslider', get_stylesheet_directory_uri() . '/_/js/jquery.bxslider.min.js', array( 'jquery' ) );
		wp_enqueue_script('nivo_slider', get_stylesheet_directory_uri() . '/_/js/jquery.nivo.slider.pack.js', array( 'jquery' ) );
		wp_enqueue_script('front_page_js', get_stylesheet_directory_uri() . '/_/js/front_page.js', array( 'bxslider', 'nivo_slider' ) );
	}
	wp_enqueue_script('custom_functions', get_stylesheet_directory_uri() . '/_/js/functions.js', array( 'jquery' ) );

	wp_localize_script( 'custom_functions', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    if ( strpos(get_page_template(), 'page-news.php') || get_the_title() == 'Campus Life' ) {
        wp_enqueue_script('match_height', get_stylesheet_directory_uri() . '/_/js/jquery.matchHeight-min.js', array( 'jquery' ) );
    }
}
add_action('wp_enqueue_scripts', 'queue_wusm_scripts');