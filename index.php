<?php

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$class = '';
			$classes = '';
			$margin = ' non-landing-page';
			if (get_the_post_thumbnail() != '') {
				$class .= ' notch';
				$margin = ' landing-page';
				echo '<div id="featured-image">';
				the_post_thumbnail('landing-page');
				echo '</div>';
			}
			if (get_field('special_header'))
				$class .= ' special-head';
			if ( $class !== '' )
				$classes = " class ='$class'";
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper clearfix">

		<?php get_sidebar(); ?>
		<?php get_sidebar( 'right' ); ?>
		<article<?php echo $classes; ?>>
			<?php
				if(get_field('special_header')) {
					$special_header = get_field('special_header');
					echo "<a class='special-header' href='" . get_permalink( $special_header->ID ) . "'>" . get_the_title( $special_header->ID ) . "</a>";
				}
				the_title('<h1>', '</h1>');
				the_content();
			endwhile;
		endif; ?>
		</article>

		

	</div>

</div>

<?php get_footer(); ?>