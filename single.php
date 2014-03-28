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

	<div class="wrapper">
		<nav id="left-col">
			<ul id="left-nav">
				<li class="top_level_page"><a href="/news">News</a></li><li class="page_item page-item-4741"><a href="http://medicine-test.wustl.edu/news/headlines/">Research News</a></li>
				<li class="page_item page-item-4713"><a href="http://medicine-test.wustl.edu/news/releases/">News Releases</a></li>
				<li class="page_item page-item-4715"><a href="http://medicine-test.wustl.edu/news/features/">Billboards</a></li>
				<li class="page_item page-item-4719"><a href="http://medicine-test.wustl.edu/news/announcements/">Announcements</a></li>
				<li class="page_item page-item-4721"><a href="http://medicine-test.wustl.edu/news/press/">In the News</a></li>
				<li class="page_item page-item-329"><a href="http://medicine-test.wustl.edu/news/in-focus/">In Focus</a></li>
				<li class="page_item page-item-4723"><a href="http://medicine-test.wustl.edu/news/leaders/">National Leaders</a></li>
				<li class="page_item page-item-436"><a href="http://medicine-test.wustl.edu/news/biomed-radio/">BioMed Radio Podcast</a></li>
			</ul>
		</nav>

		<article<?php echo $classes; ?>>
			<?php
				if(get_field('special_header')) {
					$special_header = get_field('special_header');
					echo "<a class='special-header' href='" . get_permalink( $special_header->ID ) . "'>" . get_the_title( $special_header->ID ) . "</a>";
				}
					the_title('<h1>', '</h1>');
					add_filter( 'excerpt_more', function() { return ''; } );
					echo "<p class='research-news-intro'>" . get_the_excerpt() . "</p>";
					echo "<p class='research-news-byline'>";
					the_date();
					if(get_field('author'))
						echo " | " . get_field('author');
					echo "</p>";
					the_content();
				endwhile;
			endif;
			?>
		</article>

		<?php get_sidebar( 'right' ); ?>

	</div>

</div>

<?php get_footer(); ?>