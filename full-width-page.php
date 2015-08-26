<?php
/*
 * Template Name: Full width
 * Description: A page template without left nav.
 */

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$margin = ' non-landing-page';
			if (get_the_post_thumbnail() != '') {
				$margin = ' landing-page';
				$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'landing-page' );
				echo '<div id="featured-image" style="background-image:url(' . $image . ');">';
				the_post_thumbnail('landing-page');
				echo '</div>';
			}
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background"></div>

	<div class="wrapper clearfix">

		<div id="page-background-inner"></div>

		<?php get_sidebar(); ?>

		<article>
			<?php
					the_title('<h1>', '</h1>');
					the_content();
				endwhile;
			endif;
			?>
		</article>

	</div>

</div>

<?php get_footer(); ?>