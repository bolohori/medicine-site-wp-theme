<?php

	get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		$class   = '';
		$classes = '';
		$margin  = ' non-landing-page';
		if ( get_the_post_thumbnail() != '' ) {
			$margin = ' landing-page';
			$image  = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'landing-page' );
			echo '<div id="featured-image">';
			the_post_thumbnail( 'landing-page' );
			echo '</div>';
		}
		if ( get_field( 'special_header' ) ) {
			$class .= ' special-head';
		}
		if ( $class !== '' ) {
			$classes = " class ='$class'";
		}
?>

<div id="page-background"></div>

<div id="main" class="clearfix<?php echo $margin; ?>">

<div class="wrapper clearfix">

	<div id="page-background-inner"></div>

	<?php get_sidebar(); ?>

	<article<?php echo $classes; ?>>

		<?php
		if ( get_field( 'special_header' ) ) {
			$special_header = get_field( 'special_header' );
			echo "<a class='special-header' href='" . get_permalink( $special_header->ID ) . "'>" . get_the_title( $special_header->ID ) . '</a>';
		}

			$parent_page = get_top_parent_page_id( $post->ID );
		if ( get_field( 'section_nav', $parent_page ) ) {
			?>
				<div class="section-nav"><div class="current-page-title"><?php echo get_the_title( $parent_page ); ?></div><ul><li><a href="<?php echo get_permalink( $parent_page ); ?>"><?php echo get_the_title( $parent_page ); ?></a></li>
																						<?php
																						wp_list_pages( "title_li=&child_of=$parent_page" );
					?>
					</ul></div>
					<?php
		}

			the_title( '<h1>', '</h1>' );
			the_content();
			get_template_part( '_/php/cards/footercards' );
			get_sidebar( 'right' );
			?>

		</article>
			<?php
			endwhile;
		endif;
		?>


	</div>

</div>

<?php get_footer(); ?>
