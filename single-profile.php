<?php

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$class = '';
			$classes = '';
			$margin = ' non-landing-page';
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background"></div>

	<div class="wrapper">
		<?php get_sidebar(); ?>

		<article<?php echo $classes; ?>>
			<?php
					the_title('<h1 class="profile-page-title">', '</h1>');
					add_filter( 'excerpt_more', function() { return ''; } );
					echo "<p class='custom-intro'>" . get_the_excerpt() . "</p>";
					echo "<p class='custom-byline'>";
						the_date();
					echo "</p>";
					the_post_thumbnail('landing-page');
					
					echo "<p class='wp-caption-text'>" .  get_post(get_post_thumbnail_id())->post_excerpt . "</p>";
					the_content();

				endwhile;
			endif;
			?>
		</article>

	</div>

</div>

<?php get_footer(); ?>