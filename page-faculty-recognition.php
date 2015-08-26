<?php
wp_enqueue_script( 'faculty-recognition', get_stylesheet_directory_uri() . '/_/js/faculty-recognition.js', array( 'jquery-effects-bounce' ) );
	get_header();

	if (have_posts()) :
		while (have_posts()) :
			the_post();
			$class = '';
			$classes = '';
			$margin = ' non-landing-page';
			if (get_the_post_thumbnail() != '') {
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
<div id="hover"></div>
<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background"></div>

	<div class="wrapper clearfix">

		<div id="page-background-inner"></div>

		<?php get_sidebar(); ?>

		<article<?php echo $classes; ?>>
			<?php
			the_title('<h1>', '</h1>');

	$args = array( 
		'post_type'      => 'faculty_profile',
		'posts_per_page' => -1,
		'post_parent'    => 0,
		'orderby'        => 'menu_order date',
		'order'          => 'ASC' 
	);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class='award-set'>
			<div class="award-set-title">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/_/img/brown_shield.png">
				<?php $the_link = get_permalink(); ?>
				<a href="<?php echo $the_link; ?>"><h2><?php the_title(); ?></h2>
				<div class="right-arrow">»</div></a>
			</div>
			<?php the_excerpt(); ?>
		</div>
			<?php 
			wp_reset_query(); 
			endwhile;
		endwhile;
	endif; ?>
		</article>
	</div>
</div>
<?php get_footer(); ?>