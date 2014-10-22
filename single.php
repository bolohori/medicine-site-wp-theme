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
		<nav id="left-col">
			<?php if( ! get_field( 'hide_nav' ) ) { ?>
			<ul id="left-nav">
				<li class="top_level_page"></li>
				<li class="<?php echo ($post->post_type == 'news_releases') ? "current_page_item " : ""; ?>page_item page-item-4713"><a href="/news/releases/">News Releases</a></li>
				<li class="<?php echo ($post->post_type == 'media_mentions') ? "current_page_item " : ""; ?>page_item page-item-4721"><a href="/news/press/">In the Media</a></li>
				<li class="page_item page-item-436"><a href="/news/biomed-radio/">BioMed Radio Podcast</a></li>
				<li class="<?php echo ($post->post_type == 'research_news') ? "current_page_item " : ""; ?>page_item page-item-4741"><a href="/news/headlines/">Research Highlights</a></li>
				<li class="<?php echo ($post->post_type == 'spotlight') ? "current_page_item " : ""; ?>page_item page-item-4723"><a href="/news/leaders/">National Leaders</a></li>
				<li class="page_item page-item-7224"><a href="/news/publications/">Publications</a></li>
				<li class="<?php echo ($post->post_type == 'announcements') ? "current_page_item " : ""; ?>page_item page-item-4719"><a href="/news/announcements/">Announcements</a></li>
				<li class="<?php echo ($post->post_type == 'in_focus') ? "current_page_item " : ""; ?>page_item page-item-329"><a href="/news/in-focus/">Campus Life</a></li>

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