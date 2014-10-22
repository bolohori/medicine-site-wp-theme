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
				echo '<div id="featured-image">';
				the_post_thumbnail('landing-page');
				echo '</div>';
			}
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper clearfix">

		<?php get_sidebar(); ?>

		<article<?php echo $class; ?>>
			<?php
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