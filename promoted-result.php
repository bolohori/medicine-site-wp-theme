<?php
global $search_terms;
$querystr = "SELECT $wpdb->posts.* 
			FROM $wpdb->posts 
			WHERE ID IN (
				SELECT post_id 
				FROM $wpdb->postmeta 
				WHERE $wpdb->postmeta.meta_key 
				LIKE '%promoted_result%' 
				AND $wpdb->postmeta.meta_value = '$search_terms'
			) AND $wpdb->posts.post_status = 'publish';";

$promoted_results = $wpdb->get_results( $querystr, OBJECT );

if ( $promoted_results ) {

	echo '<h2>Top search results</h2>';

	foreach ( $promoted_results as $post ) {

		setup_postdata( $post );

		if ( $post->post_type == 'promoted_results' ) {

			//result_url
			add_filter(
				'excerpt_more', function() {
					return '... <a class="read-more" href="' . get_field( 'result_url', get_the_ID() ) . '">MORE»</a>';
				}
			);
			$link = get_field( 'result_url', $post->ID );

		} else {

			add_filter(
				'excerpt_more', function() {
					return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">MORE»</a>';
				}
			);
			$link = get_permalink();

		}

		echo "<p class='search-results'>";
		echo "<span style='font-size: 16px;'><a data-category=\"top-search-result-" . esc_html( $search_terms ) . "\" data-action=\"$link\" href='$link'><b>" . get_the_title() . '</b></a></span><br>';

		if ( ( $post_excerpt = get_the_excerpt() ) !== '' ) {

			echo "$post_excerpt<br>";

		}

		echo "<a href='$link' class='result-url'>$link</a>
		</p>";

	}

	echo '<hr>';

}

add_filter(
	'excerpt_more', function() {
		return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">MORE»</a>';
	}
);

// Restore original Post Data
wp_reset_postdata();
