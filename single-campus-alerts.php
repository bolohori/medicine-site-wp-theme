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
				$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'landing-page' );
				echo '<div id="featured-image" style="background-image:url(' . $image . ');">';
				the_post_thumbnail('landing-page');
				echo '</div>';
			}
			if (get_field('special_header'))
				$class .= ' special-head';
			if ( $class !== '' )
				$classes = " class ='$class'";
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background"></div>

	<div class="wrapper clearfix">

		<div id="page-background-inner"></div>
		
		<nav id="left-col">
			<?php if( ! get_field( 'hide_nav' ) ) { ?>
			<ul id="left-nav">
				<li class="top_level_page"></li>
				<li class="current_page_item page_item"><a href="/campus-alerts/">Campus Alerts</a></li>
				
			</ul>
			<?php } ?>
		</nav>
		
		<?php if( $post->post_type != 'in_focus' && $post->post_type != 'spotlight' )get_sidebar( 'right' ); ?>

		<article<?php echo $classes; ?>>
			<?php
				if(get_field('special_header')) {
					$special_header = get_field('special_header');
					echo "<a class='special-header' href='" . get_permalink( $special_header->ID ) . "'>" . get_the_title( $special_header->ID ) . "</a>";
				}
					the_title('<h1>', '</h1>');
					add_filter( 'excerpt_more', function() { return ''; } );
					echo "<p class='custom-byline'>";
					the_date();
					if(get_field('author'))
						echo " | " . get_field('author');
					echo "</p>";
					if( get_the_content() ) {
						the_content();
					} else {
						$link = get_field( 'external_link' );
						$button_text = $link['title'] !== null ? $link['title'] : "Read Article";
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