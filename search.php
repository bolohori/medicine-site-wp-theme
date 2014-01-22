<?php
global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);
?>
<?php get_header(); ?>
 <div id="main" class="clearfix non-landing-page">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper">
		<nav id="left-col">
		</nav>

		<article>
				<?php  $start = (get_query_var('start')) ? get_query_var('start') : 1;  ?>
				
				<h1>Search Results</h1>
				<?php 
				$args = array( 'post_type' => 'promoted_results', 'posts_per_page' => -1 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					// check if the repeater field has rows of data
					if( have_rows('results_to_promote') ):
						echo "<h2>Top Result(s) for the School of Medicine</h2>";
						// loop through the rows of data
						while ( have_rows('results_to_promote') ) : the_row();
							$result = get_sub_field('result');
							echo "<p style='width: 515px;'>
							<span style='font-size: 16px;'><a href='".$result['url']."'><b>".$result['title']."</b></a></span><br>
							".get_sub_field('result_description')."<br>
							<a href='".$result['url']."' class='search-url'>".$result['url']."</a>
							</p>";
						endwhile;
						echo "<hr>";
					endif;
				endwhile;
				wp_reset_postdata();
				?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						echo "<p style='width: 515px;'>
						<span style='font-size: 16px;'><a href='".get_permalink()."'><b>".get_the_title()."</b></a></span><br>
						".the_excerpt()."<br>
						<a href='".get_permalink()."' class='search-url'>".get_permalink()."</a>
						</p>";
					endwhile;
				endif; ?>
				<hr>
				<?php
				$search_url = 'http://googlesearch.wulib.wustl.edu/search?q=' . get_search_query() . '&output=xml_no_dtd&filter=1&start=' . $start;

				$xml = new SimpleXMLElement(file_get_contents($search_url));

				$pager_max = 15;
				$p_start = 1;
				$cnt_per_page = 10;

				$num_results = $xml->RES->M;
				$page_cnt = ceil($num_results / $cnt_per_page);
				$start_num = $xml->RES['SN'];

				if( $start > $start_num ) {
					$start = $start_num - 1;
				}

				// Google seems to choke around the 1000th result, so limit results to 1000 matches
				//$num_results_to_display = 1000;
				$max = $xml->RES->M;
				//if( $xml->RES->M >= $num_results_to_display ) {
				//  $max = $num_results_to_display;
				//}

				// Adjust the end count if it is less than the total count per page. For example, if there are only
				// 7 results but the default is to display 10 per page, don't show: Results 1 - 7 of 10
				$end_cnt = $cnt_per_page;
				if( ($num_results - $start) < $cnt_per_page ) {
					$end_cnt = $num_results - $start;
				}
				
				// If there are no matching results, display appropriate message
				if( ! $xml->RES ) {
					echo "<p>No pages were found containing: <strong>" . get_search_query() . "</strong>.</p>\n";
				} 

				// Display page of search results
				foreach( $xml->RES->R as $result ) { ?>
					<p style="width: 515px;">
					<span style="font-size: 16px;"><a href="<?php echo $result->U; ?>"><?php echo $result->T; ?></a></span>
					<?php if( $result->S != '' ) { ?>
						<br><?php echo $result->S; ?>
					<?php } ?>
					<br/><a href="<?php echo $result->U; ?>" class="search-url"><?php echo $result->U; ?></a>
					</p>
				<?php } ?>
				
				<?php 
					// If there are more than one page of results, show pager navigation
					if( $page_cnt > 1 ) {
			
						// Determine number of pages in pager navigation
						
						// Default to total page count
						$pages = $page_cnt;
												
						// If there are fewer pages than pager allows, show that amount
//                      if( $page_cnt <= $pager_max ) {
//                          $page_cnt = $pager_max;
//                      }
												
						// For first 10 pages, keep pager navigation static
						if( ($start / $cnt_per_page) < $cnt_per_page ) {
							if( $page_cnt < $pager_max ) {
								$p_end = $page_cnt;
							} else {
								$p_end = $pager_max;
							}

						// Otherwise, starting on page 11, pull one page from beginning of pager navigation
						// and add it to the end, thus maintaining $pager_max items in navigation
						} else {
							// Google Appliance seems to choke around 1000th result, so stop pager navigation one page before
							if( $start >= (1000 - $cnt_per_page) ) {
								$p_start = pow($cnt_per_page, 2) - $pager_max - 1;
								$p_end = $p_start + $pager_max;
							} else {
								$p_start = (abs(pow($cnt_per_page, 2) - $start) / $cnt_per_page) + 1;
								$p_end = $p_start + ($pager_max-1);
								if( $p_end > $page_cnt ) {
									$p_end = $page_cnt;
								}
							}
						}
						
						if( $p_end >= pow($cnt_per_page, 2) ) {
							$p_start = pow($cnt_per_page, 2) - $pager_max - 1;
							$p_end = pow($cnt_per_page, 2) - 1;
						}
						
						$search_terms = get_search_query();
						echo "<p style=\"width: 750px;\">Page: ";
						if( $p_start != 1 ) {
							$back = $start - $cnt_per_page;
							echo "<a href=\"/?s=$search_terms&start=$back\">&lt;&lt;</a>&nbsp;&nbsp;&nbsp;";
						}
						for( $i=$p_start; $i<=$p_end; $i++ ) {          
							if( (($start+10) / $cnt_per_page) != $i ) {
								$next_page = ($i * $cnt_per_page) - 10;
								echo "<a href=\"/?s=$search_terms&start=$next_page\">$i</a>";
							} else {
								echo "$i";
							}
							echo "&nbsp;&nbsp;&nbsp;";
						}
						$adv = $start + $cnt_per_page;
						
						if( $p_end != $page_cnt ) {
							echo "<a href=\"/?s=$search_terms&start=$adv\">&gt;&gt;</a>";
						}
						echo "</p>";
					}
				?>


				<p style="font-size: 12px;">Powered by Google Search Appliance</p>
			</article>

		<?php get_sidebar( 'right' ); ?>

	</div>

</div>

<?php get_footer(); ?>