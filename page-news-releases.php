<?php

$num_to_fetch = apply_filters( "{$post_type}_num_per_page", 30 );

get_header(); ?>
<div id="page-background"></div>
	<div id="main" class="clearfix">
	<div class="wrapper clearfix">
		<div id="page-background-inner"></div>
		<?php get_sidebar(); ?>

		<article>
			<?php
			the_title( '<h1>', '</h1>' );
			the_content();

			// WP_Query arguments
			$args = array(
				'news'           => 'news-release',
				'posts_per_page' => $num_to_fetch,
				'paged'          => $paged,
			);

			// The Query
			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					get_template_part( '_/php/cards/news-release' );
				}
				echo '<hr>';
				wp_reset_postdata();
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
								'current'   => max( 1, get_query_var( 'paged' ) ),
								'total'     => $query->max_num_pages,
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
