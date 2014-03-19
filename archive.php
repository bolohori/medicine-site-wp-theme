<?php get_header(); 
$header_option = "featured_image_" . get_post_type();
$url = get_option($header_option, false);
$class = '';
$classes = '';
$margin = ' non-landing-page';
if( $url ) {
	$class .= ' notch';
	$margin = ' landing-page';
	echo '<div id="featured-image">';
	echo wp_get_attachment_image($url, 'landing-page');
	echo '</div>';
} 
if( $class !== '' )
	$classes = " class ='$class'";
?>

<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper">
		
		<nav id="left-col">
			<ul id="left-nav">
				<li>News</li>
				<li><a href="<?php echo get_post_type_archive_link( 'news_releases' ); ?>">News Releases</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'billboard' ); ?>">Billboards</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'announcement' ); ?>">Announcements</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'media_mentions' ); ?>">In the Media</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'in_focus' ); ?>">In Focus</a></li>
				<li><a href="<?php echo get_post_type_archive_link( 'spotlight' ); ?>">National Leaders</a></li>
			</ul>
		</nav>

		<article<?php echo $classes; ?>>
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