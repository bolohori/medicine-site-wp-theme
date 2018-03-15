<?php
// Grab the global variable since we're going to be messing with it
global $query_string;

// Grab all the arguments from the URL
$query_args = explode( '&', $query_string );

// This is where we're going to stuff the arguments
$search_query = array();

// and this is how we stuff those arguments into the array
foreach ( $query_args as $key => $string ) {
	$query_split = explode( '=', $string );
	$search_query[ $query_split[0] ] = urldecode( $query_split[1] );
} // foreach

// We've got our "hacked" query ready to run, so run it
// uh...don't need this
//$search = new WP_Query($search_query);

// Now that our hacked query has been run, we can treat it like it wasn't hacked
$search_terms = get_search_query();

// To use data from the query results, we need the global variable
global $wp_query;

// This is where we're going to keep "promoted results" and WP's results
// The number of WP search results
$num_of_wordpress_results = $wp_query->found_posts;

// and how many results are on the last page?
$last_wp_page_results_cnt = $num_of_wordpress_results % 10;

$num_of_funnelback_results = ( $last_wp_page_results_cnt == 0 ) ? 10 : 10 - $last_wp_page_results_cnt;

// so hackey, if we go past the last page it flips out so we've gotta back
// up a bit to get some important numbers
if ( ( $num_of_wordpress_results == 0 ) && ( $paged != 1 ) ) {
	// We've got our twice-hacked "hacked" query ready to run, so run it
	$search_query['paged'] = 1;
	$hacked_query = new WP_Query( $search_query );

	$num_of_wordpress_results = $hacked_query->found_posts;
}

// How many pages of WP results do we have (with 10 results per page)
$num_of_wp_result_pages = ceil( $num_of_wordpress_results / 10 );

// Spaces are BAD in search terms
$terms = str_replace( ' ', '+', $search_terms );

/**
 * NEW FUNNELBACK STUFF!!!
 */

$collection = 'wustl-gsa-meta';
$profile = '_default';
$start_rank = 11;
$search_url = "https://search.wustl.edu/s/search.json?collection=$collection&profile=$profile&query=$terms&start_rank=$start_rank";
$json = file_get_contents( $search_url );
$search_results = json_decode( $json );
$total_funnelback_results = $search_results->response->resultPacket->resultsSummary->totalMatching;

/**
 * END FUNNELBACK
 */

if ( ! isset( $paged ) || $paged == 0 ) {
	$paged = 1;
}

// Google result to start with
$start = ( $num_of_wp_result_pages + 1 == $paged ) ? 0 : ( ( $paged - $num_of_wp_result_pages - 1 ) * 10 );

// Total pages of results, displaying 10 items per page
//$pages_of_results = ceil(($num_of_wordpress_results + $total_google_results) / 10);
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

				// and finally the results from Google...
				//$terms = str_replace(' ', '+', $search_terms);
				//$search_url = "http://googlesearch.wulib.wustl.edu/search?q=$terms&output=xml_no_dtd&filter=1&start=$start&num=$num_of_funnelback_results&as_eq=medschool.wustl.edu+medicine.wustl.edu";
				//$xml = new SimpleXMLElement(file_get_contents($search_url));
				//$start_num = $xml->RES['SN'];

				if ( $start > $start_rank ) {
					$start = $start_rank - 1;
				}

				// Adjust the end count if it is less than the total count per page. For example, if there are only
				// 7 results but the default is to display 10 per page, don't show: Results 1 - 7 of 10
				$end_cnt = 10;

				if ( ( $total_funnelback_results - $start ) < 10 ) {
					$end_cnt = $total_funnelback_results - $start;
				}

				//var_dump($search_results->response->resultPacket->results);

				// Display page of search results
				if ( $search_results->response->resultPacket->results ) {
					echo '<h2>More WUSTL results</h2>';
					foreach ( $search_results->response->resultPacket->results as $result ) {
					?>
						<p class='search-result'>
						<span style="font-size: 16px;"><a onclick="__gaTracker('send','event','search-result-<?php echo $search_terms; ?>','<?php echo $result->liveUrl; ?>');" href="<?php echo $result->liveUrl; ?>"><?php echo $result->title; ?></a></span>
						<?php if ( $result->summary != '' ) { ?>
							<br><?php echo $result->summary; ?>
						<?php } ?>
						<br/><a onclick="__gaTracker('send','event','search-result-<?php echo $search_terms; ?>','<?php echo $result->liveUrl; ?>');" href="<?php echo $result->liveUrl; ?>" class="result-url"><?php echo $result->liveUrl; ?></a>
						</p>
				<?php
					}
					// If there are duplicate results, Google won't tell you until you hit the last page of
					// "real" results, this checks that and adds the standard Google message
					/*if ( ( (int) $xml->RES->M !== $total_funnelback_results ) && ( sizeof( $xml->RES->R ) < 10 ) ) {
						echo "<p style='font-size: 16px;'><i>In order to show you the most relevant results, we have omitted some entries very similar to the " . $xml->RES->M . ' already displayed.</i></p>';
						$truncate_pagination = $paged;
					}*/
				}
				
			}

			// If there are more than one page of results, show pager navigation
			if ( $pages_of_results > 1 ) {

				// For first 10 pages, keep pager navigation static
				if ( $paged < 10 ) {

					$p_start = 1;

					if ( $pages_of_results < 15 ) {

						$p_end = $pages_of_results;

					} else {

						$p_end = 15;

					}

					// Otherwise, starting on page 11, pull one page from beginning of pager navigation
					// and add it to the end, thus maintaining 15 items in navigation
				} else {

					$p_start = $paged - 10;
					$p_end = $paged + 4;

				}

				if ( $p_end > $pages_of_results ) {

					$p_end = $pages_of_results;

				}

				if ( isset( $truncate_pagination ) ) {

					$p_end = $truncate_pagination;

				}

				echo "<p style='max-width: 750px;word-wrap: break-word;'>Page: ";

				if ( $p_start != 1 ) {

					$back = $paged - 1;
					echo "<a href='/?s=$search_terms&paged=$back'>&lt;&lt;</a>&nbsp;&nbsp;&nbsp;";

				}

				for ( $i = $p_start; $i <= $p_end; $i++ ) {

					if ( $paged != $i ) {

						echo "<a href='/?s=$search_terms&paged=$i'>$i</a>";

					} else {

						echo "$i";

					}

					echo '&nbsp;&nbsp;&nbsp;';

				}

				$adv = $paged + 1;

				if ( ( $p_end != $pages_of_results ) && ! isset( $truncate_pagination ) ) {

					echo "<a href='/?s=$search_terms&paged=$adv'>&gt;&gt;</a>";

				}

				echo '</p>';
			}
			?>

		</article>

	</div>

</div>

<?php get_footer(); ?>
