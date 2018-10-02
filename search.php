<?php
// Grab the global variable since we're going to be messing with it
global $query_string;

// Grab all the arguments from the URL
$query_args = explode( '&', $query_string );

// This is where we're going to stuff the arguments
$search_query = array();

// and this is how we stuff those arguments into the array
foreach ( $query_args as $key => $string ) {
	$query_split                     = explode( '=', $string );
	$search_query[ $query_split[0] ] = urldecode( $query_split[1] );
} // foreach

// We've got our "hacked" query ready to run, so run it
// uh...don't need this
// $search = new WP_Query($search_query);
// Now that our hacked query has been run, we can treat it like it wasn't hacked
$search_terms = get_search_query();

// To use data from the query results, we need the global variable
global $wp_query;

// This is where we're going to keep "promoted results" and WP's results
// The number of WP search results
$num_of_wordpress_results = $wp_query->found_posts;

// How many pages of WP results do we have (with 10 results per page)
$num_of_wp_result_pages = (int) ceil( $num_of_wordpress_results / 10 );

// and how many results are on the last page?
$last_wp_page_results_cnt = $num_of_wordpress_results % 10;

// If we get 0 back then we need to set the number to 10 so we can
// correctly calculate the starting position for the Funnelback
// results later.
if ( 0 === $last_wp_page_results_cnt ) {
	$last_wp_page_results_cnt = 10;
}

if ( ! isset( $paged ) || $paged == 0 ) {
	$paged = 1;
}

$num_of_funnelback_results = 0;
if ( $paged === $num_of_wp_result_pages ) {
	$num_of_funnelback_results = 10 - $last_wp_page_results_cnt;
}
if ( $paged > $num_of_wp_result_pages ) {
	$num_of_funnelback_results = 10;
}

// so hackey, if we go past the last page it flips out so we've gotta back
// up a bit to get some important numbers
if ( ( $num_of_wordpress_results == 0 ) && ( $paged != 1 ) ) {
	// We've got our twice-hacked "hacked" query ready to run, so run it
	$search_query['paged'] = 1;
	$hacked_query          = new WP_Query( $search_query );

	$num_of_wordpress_results = $hacked_query->found_posts;
}

// Spaces are BAD in search terms
$terms = str_replace( ' ', '+', $search_terms );

// Funnelback result to start with
$start = ( ( $paged - $num_of_wp_result_pages - 1 ) * 10 ) + ( $num_of_funnelback_results - $last_wp_page_results_cnt ) + 1;

/**
 * NEW FUNNELBACK STUFF!!!
 */

// I thought we could only run this if we're in the Funnelback results, but we need the count
// to populate the pagination.

$collection               = 'wustl-gsa-meta';
$profile                  = '_default';
$search_url               = "https://search.wustl.edu/s/search.json?collection=$collection&profile=$profile&query=$terms&start_rank=$start&num_ranks=$num_of_funnelback_results";
$json                     = file_get_contents( $search_url );
$search_results           = json_decode( $json );
$total_funnelback_results = $search_results->response->resultPacket->resultsSummary->totalMatching;

/**
 * END FUNNELBACK
 */


// Total pages of results, displaying 10 items per page
// $pages_of_results = ceil(($num_of_wordpress_results + $total_google_results) / 10);
$pages_of_results = ceil( ( $num_of_wordpress_results + $total_funnelback_results ) / 10 );

get_header(); ?>
 <div id="main" class="clearfix non-landing-page">

	<div id="page-background"></div>

	<div class="wrapper">

		<div id="page-background-inner"></div>
		
		<nav id="left-col">
		</nav>

		<article>
			<h1>Your Search: <em><?php echo $search_terms; ?></em></h1>
			<?php

			// If there are no matching results, display appropriate message
			if ( ! ( $num_of_wordpress_results + $total_funnelback_results ) ) {
				echo '<p>No pages were found containing: <strong>' . $search_terms . "</strong>.</p>\n";
			}

			// Only display "promoted results" on the first page
			if ( 1 === $paged ) {
				get_template_part( 'promoted-result' );
			}

			// These are WordPress' search results
			if ( have_posts() ) {

				echo '<h2>medicine.wustl.edu results</h2>';

				while ( have_posts() ) {

					the_post();
					$num_of_wordpress_results++;

					$link = get_permalink();

					echo "<p class='search-results'>";
					echo "<span style='font-size: 16px;'><a href='$link'><b>" . get_the_title() . '</b></a></span><br>';

					if ( '' !== ( $post_excerpt = get_the_excerpt() ) ) {
						echo "$post_excerpt<br>";
					}

					echo "<a href='$link' class='result-url'>$link</a>";
					echo '</p>';

				}
			}

			// Visual separator to mark end of WP search and start of Google search
			if ( $num_of_wp_result_pages == $paged ) {
				echo '<hr>';
			}

			if ( ( $num_of_wp_result_pages <= $paged ) || ( $num_of_wp_result_pages < 2 ) ) {

				// Display page of search results
				if ( $search_results->response->resultPacket->results ) {
					echo '<h2>More WUSTL results</h2>';
					foreach ( $search_results->response->resultPacket->results as $result ) {
					?>
						<p class='search-result'>
						<span style="font-size: 16px;"><a data-category="search-result-<?php echo filter_var( $search_terms, FILTER_SANITIZE_STRING ); ?>" data-action="<?php echo $result->liveUrl; ?>" href="<?php echo $result->liveUrl; ?>"><?php echo $result->title; ?></a></span>
						<?php if ( $result->summary != '' ) { ?>
							<br><?php echo $result->summary; ?>
						<?php } ?>
						<br/><a data-category="search-result-<?php echo $search_terms; ?>" data-action="<?php echo $result->liveUrl; ?>" href="<?php echo $result->liveUrl; ?>" class="result-url"><?php echo $result->liveUrl; ?></a>
						</p>
				<?php
					}
				}
			}
			?>
			<nav class="navigation pagination" role="navigation">
				<h2 class="screen-reader-text">Posts navigation</h2>
				<div class="nav-links">
				<?php
				$big = 999999999; // need an unlikely integer

				echo paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'current'   => $paged,
						'total'     => $pages_of_results,
						'prev_text' => __( '‹ Prev' ),
						'next_text' => __( 'Next ›' ),
					)
				);
				?>
				</div>
			</nav>
		</article>

	</div>

</div>

<?php get_footer(); ?>
