<?php
if ( is_category() || is_tax() ) {
	$type_type = 'news';
	$post_type = get_query_var( 'news' );
} else {
	$type_type = 'post_type';
	$post_type = get_post_type();
}

$num_to_fetch = apply_filters( "{$post_type}_num_per_page", 30 );

get_header(); ?>
<div id="page-background"></div>
	<div id="main" class="clearfix">
	<div class="wrapper clearfix">
		<div id="page-background-inner"></div>
		<?php get_sidebar(); ?>

		<article>
			<h1><?php the_archive_title(); ?></h1>
			<?php
			$template = locate_template( "_/php/headers/$post_type.php" );
			if ( '' !== $template ) {
				get_template_part( "_/php/headers/$post_type" );
			}
			?>
			<?php if ( have_posts() ) { ?>
				<?php
				if ( 0 === $paged ) {
					// WP_Query arguments
					$args = array(
						$type_type       => $post_type,
						'posts_per_page' => $num_to_fetch,
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'meta_key'       => 'sticky',
						'meta_value'     => 1,
					);

					// The Query.
					$query = new WP_Query( $args );

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {

							$query->the_post();
							$template = locate_template( "_/php/cards/$post_type.php" );
							if ( '' === $template ) {
								get_template_part( '_/php/news/card' );
							} else {
								get_template_part( "_/php/cards/$post_type" );
							}
						}
						echo '<hr>';
						wp_reset_postdata();
					}
				}
				while ( have_posts() ) {
					the_post();

					$template = locate_template( "_/php/cards/$post_type.php" );
					if ( '' === $template ) {
						get_template_part( '_/php/news/card' );
					} else {
						get_template_part( "_/php/cards/$post_type" );
					}
				}
?>
				<nav class="navigation pagination" role="navigation">
					<h2 class="screen-reader-text">Posts navigation</h2>
					<div class="nav-links">
					<?php
						global $wp_query;
						$big = 999999999; // need an unlikely integer

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
			<?php } ?>
		</article>
	</div>
	</div>
<?php get_footer(); ?>
