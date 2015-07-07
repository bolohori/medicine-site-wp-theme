<?php
/*
 * The actual Faculty Profile Custom Post Type is created in /inc/php/custom_post_types.php
 * it's registered as 'faculty_profile'
 */

function get_awards_by_year() {
	$year = $_POST['year']; // getting variables from ajax post
	// doing ajax stuff
	
	$args = array (
		'post_parent' => $year, 
		'post_type'   => 'faculty_profile',
		'orderby'     => 'menu_order',
		'order'       => 'asc'
	);
	$my_query = new WP_Query( $args );
	if ( $my_query->have_posts() ) { 
		echo "<ul class='award-list'>";
		while ( $my_query->have_posts() ) { 
			$my_query->the_post();
			//echo "<li>" . get_the_title() . "</li>";
			echo "<li><div class='faculty-individual clearfix'><a href='".get_permalink()."'>";
				the_post_thumbnail();
			echo "</a><div><h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>
					<p class='award-name'>".get_field('award_name')."</p>
					<p>".get_the_excerpt( )."</p></div>
			</div></li>";
		}
		echo "</ul>";
	}
	wp_reset_postdata();

	die(); // stop executing script
}
add_action( 'wusm_ajax_get_awards', 'get_awards_by_year' ); // ajax for logged in users
add_action( 'wusm_ajax_nopriv_get_awards', 'get_awards_by_year' ); // ajax for not logged in users