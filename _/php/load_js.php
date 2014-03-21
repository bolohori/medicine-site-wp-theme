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

	
	wp_enqueue_script( 'faculty-recognition', get_stylesheet_directory_uri() . '/_/js/faculty-recognition.js', array( 'jquery-effects-bounce' ) );
	
	// embed the javascript file that makes the AJAX request
	wp_enqueue_script( 'my-ajax-request', get_stylesheet_directory_uri() . '/_/js/ajax-functions.js', array( 'jquery' ) );
}
add_action('wp_enqueue_scripts', 'scripts');

// Thanks Otto!
// http://wordpress.org/support/topic/ajaxurl-is-not-defined
function ajax_init() { ?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	<?php
}

add_action( 'head', array( $this, 'ajax_init' ) );