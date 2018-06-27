<?php

get_header(); ?>

	<div id="main" class="page-news clearfix">

		<?php get_template_part( '_/php/news/header' ); ?>

		<article>

			<div class="news-type-title"><p>Source: Audio</p></div>

			<?php
			$args      = array(
				'post_type'      => 'post',
				'posts_per_page' => 24,
				'paged'          => $paged,
				'meta_query'     => array(
					array(
						'key'     => 'audio',
						'compare' => '!=',
						'value'   => '',
					),
				),
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) {
?>
						<div class="news-cards">
							<ul class="clearfix">
							<?php
							while ( $the_query->have_posts() ) {
								$the_query->the_post();

								get_template_part( '_/php/news/card' );

							}
?>
				</ul>
			</div>
			<nav class="navigation pagination" role="navigation">
				<h2 class="screen-reader-text">Posts navigation</h2>
				<div class="nav-links">
				<?php
				$big = 999999999; // need an unlikely integer

				echo paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $the_query->max_num_pages,
						'prev_text' => __( '‹ Prev' ),
						'next_text' => __( 'Next ›' ),
					)
				);
				?>
			   </div>
			</nav>
			<?php } ?>

		</article>

	</div>


<?php get_footer(); ?>
