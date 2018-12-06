<?php
get_header();
global $wp_query;
$curauth = get_user_by( 'slug', $wp_query->query['author_name'] );
?>

	<div id="main" class="page-news clearfix">

		<?php get_template_part( '_/php/news/author' ); ?>

		<article>

			<?php
			echo '<div class="news-type-title"><p>Stories by: ' . $curauth->display_name . '</p></div>';

			if ( have_posts() ) {
			}
			?>
			<div class="news-cards">
				<ul class="clearfix">
				<?php
				while ( have_posts() ) {
					the_post();

					get_template_part( '_/php/news/card' );

				}
				?>
				</ul>
				<nav class="navigation pagination" role="navigation">
					<h2 class="screen-reader-text">Posts navigation</h2>
					<div class="nav-links">
					<?php
						global $wp_query;
						$big = 999999999; // need an unlikely integer

						echo paginate_links(
							array(
								'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'current'   => max( 1, get_query_var( 'paged' ) ),
								'total'     => $wp_query->max_num_pages,
								'prev_text' => __( '‹ Prev' ),
								'next_text' => __( 'Next ›' ),
							)
						);
						?>
					</div>
				</nav>

		</article>

	</div>

<?php get_footer(); ?>
