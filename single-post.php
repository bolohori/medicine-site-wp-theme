<?php
/*
 * Template Name: Full width
 * Description: A page template without left nav.
 */
	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$class = '';
			$margin = ' non-landing-page';
			if (get_the_post_thumbnail() != '') {
				$class = ' class="notch"';
				$margin = ' landing-page';
				$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'landing-page' );
				echo '<div id="featured-image" style="background-image:url(' . $image . ');">';
				the_post_thumbnail('landing-page');
				echo '</div>';
			}
global $content_width;
$content_width = 700;

?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background"></div>

	<div class="wrapper clearfix">

		<div id="page-background-inner"></div>

		<?php get_sidebar(); ?>

		<article class='full-width'>
			<?php
					if ( current_user_can('edit_pages' ) ) {
						echo "<p class='dist-links'>";
						echo "<a href='" . get_the_permalink() . "?newstype=newsroom' target='_blank'>Newsroom version</a> - ";
						echo "<a href='" . get_the_permalink() . "?newstype=maestro' target='_blank'>Maestro version</a>";
						echo "</p>";
					}
					the_title('<h1>', '</h1>');
					the_content();
				endwhile;
			endif;
			?>
		</article>

		<?php /*get_sidebar( 'right' );*/ ?>

	</div>

</div>

<?php get_footer(); ?>