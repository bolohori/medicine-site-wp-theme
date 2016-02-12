<?php get_header(); ?>

<div id="main" class="clearfix">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper clearfix">

		<?php get_sidebar(); ?>
		<article>
			<h1>In the News archive</h1>
		<?php
		// WP_Query arguments
		$args = array (
			'post_type'              => 'in_the_news',
			'posts_per_page'         => '-1',
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$link = get_the_permalink();
				the_title('<h1 style="margin-top:20px;"><a href="' . $link . '">', '</a></h1>');
			}
		} else {
			// no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();
		?>
		</article>

	</div>

</div>

<?php get_footer(); ?>