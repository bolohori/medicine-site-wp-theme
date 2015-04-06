<?php

	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$class = '';
			$classes = '';
			$margin = ' non-landing-page';
			if (get_the_post_thumbnail() != '' && ! in_array( $post->post_type, array( 'in_focus', 'spotlight' ) ) ) {
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

	<div class="wrapper">
		<?php get_sidebar(); ?>

		<article<?php echo $classes; ?>>
			<?php
				if(get_field('special_header')) {
					$special_header = get_field('special_header');
					echo "<a class='special-header' href='" . get_permalink( $special_header->ID ) . "'>" . get_the_title( $special_header->ID ) . "</a>";
				}
					the_title('<h1>', '</h1>');
					add_filter( 'excerpt_more', function() { return ''; } );
					if( $post->post_type != 'in_focus' && $post->post_type != 'spotlight' ) {
						echo "<p class='custom-intro'>" . get_the_excerpt() . "</p>";
					}
					echo "<p class='custom-byline'>";
					the_date();
					if(get_field('author'))
						echo " | " . get_field('author');
					echo "</p>";
					if( get_the_content() ) {
						the_content();
					} else {
						$link = get_field( 'url' );
						if($post->post_type == 'news_releases') {
							$button_text = "See News Release";
						} elseif($post->post_type == 'announcement') {
							$button_text = "View Announcement";
						} else {
							$button_text = "View Article";
						}
						the_excerpt();
						echo "<br><a href='{$link['url']}'><button class='single-link'>$button_text</button></a>";
					}
				endwhile;
			endif;
			?>
		</article>

	</div>

</div>

<?php get_footer(); ?>