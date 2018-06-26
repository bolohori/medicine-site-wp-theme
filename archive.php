<?php get_header(); ?>

	<div id="main" class="page-news clearfix">

		<?php get_template_part( '_/php/news/header' ); ?>

		<article>
			<?php
			the_archive_title( '<h2 class="news-type-title">', '</h2>' );

			if ( have_posts() ) {
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
						$big = 999999999; // need an unlikely integer.

						echo paginate_links(
							array(
								'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'current' => max( 1, get_query_var( 'paged' ) ),
								'total'   => $wp_query->max_num_pages,
							)
						);
					?>
					</div>
				</nav>
			</div>
				<?php
			}
			?>
		</article>

	</div>

<?php get_footer(); ?>
