<?php
/*
 * The actual Faculty Profile Custom Post Type is created in /inc/php/custom_post_types.php
 * it's registered as 'faculty_profile'
 */

function get_awards_by_year() {
	echo "HELLO";
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "wusm_nonce")) {
	      exit("Processing error");
	 }

	$year = $_POST['year']; // getting variables from ajax post
	// doing ajax stuff
	
	$args = array (
		'post_parent' => $year, 
		'post_type' => 'faculty_profile',
		'orderby' => 'menu_order',
		'order' => 'asc'
	);
	$my_query = new WP_Query( $args );
	if ( $my_query->have_posts() ) { 
		echo "<ul class='award-list'>";
		while ( $my_query->have_posts() ) { 
			$my_query->the_post();
			//echo "<li>" . get_the_title() . "</li>";
			echo "<li>";
				the_post_thumbnail( 'faculty-list', array( 'class' => 'faculty-photo-med' ) );
			echo "<div class='faculty-descrip'>
					<h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>
					<div>".get_field('award_name')."</div>
					<p>".get_the_excerpt( )."</p>
				</div>
			</li>";
		}
		echo "</ul>";
	}
	wp_reset_postdata();

	die(); // stop executing script
}
add_action( 'wp_ajax_get_awards', 'get_awards_by_year' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_get_awards', 'get_awards_by_year' ); // ajax for not logged in users