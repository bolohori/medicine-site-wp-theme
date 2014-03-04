<?php get_header(); ?>

<div id="main" class="clearfix">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper">
		
		<nav id="left-col">
			<ul id="left-nav">
				<li><a href="<?php echo get_post_type_archive_link( 'billboard' ); ?>">Billboards</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'announcement' ); ?>">Announcements</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'news_releases' ); ?>">News Releases</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'media_mentions' ); ?>">Media Mentions</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'spotlight' ); ?>">National Leaders</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'in_the_news' ); ?>">In the News</a></li>
			</ul>
		</nav>

		<article>
			<h1><?php post_type_archive_title(); ?> Archive</h1>
			<?php
			if (have_posts()) :
			while (have_posts()) :
					the_post();
					$link = get_permalink();
					$text = get_the_title();
					$date = get_the_date();
					echo "<p><a href='$link'>$text</a><br>$date</p>";
				endwhile;
			endif;
			?>
		</article>

		<?php get_sidebar( 'right' ); ?>

	</div>

</div>

<?php get_footer(); ?>