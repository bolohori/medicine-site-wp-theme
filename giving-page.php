<?php
/*
 * Template Name: Giving
 * Description: A page template without left nav and background.
 */

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
		$class = '';
		$margin = ' non-landing-page';
		if (get_the_post_thumbnail() != '') {
			$class = ' class="giving-notch"';
			$margin = ' landing-page';
			echo "<div id='featured-image'>";
			echo "<div id='featured-text'>";
			the_field('header_text');
			echo "</div>";
			the_post_thumbnail('landing-page');
			echo "</div>";
		}
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background"></div>

	<div class="wrapper">

		<nav id="left-col">
		</nav>

		<article<?php echo $class; ?>>
			<?php
					the_title('<h1>', '</h1>');
					the_content();
				endwhile;
			endif;
			?>
		</article>

		<?php get_sidebar( 'right' ); ?>

	</div>

</div>

<?php get_footer(); ?>