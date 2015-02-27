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
<div id="hover"></div>
<div id="main" class="clearfix<?php echo $margin; ?>">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper clearfix">

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
				<div class="photo-container">
				<?php
				$grandchild_ids = array();
				$id = get_the_ID();
				$children = get_pages( 
					array('sort_order'  => 'asc',
						  'sort_column' => 'menu_order', 
						  'post_type'   => 'faculty_profile', 
						  'child_of'    => $id,
						  'parent'      => $id
					)
				);
				
				$total_children = 0;
				foreach($children as $child) { 
					$args = array(
						'post_parent' => $child->ID,
						'post_type'   => 'faculty_profile', 
						'numberposts' => -1,
						'post_status' => 'publish' );
					$kids = get_children( $args );
					$total_children += sizeof( $kids );
					
					foreach ($kids as $grandchild) {
						$grandchild_ids[] = $grandchild->ID;
					}
					
					if ( $total_children > 8 )
						break;
				}
				
				$args = array(
					'post_type' => 'faculty_profile',
					'orderby'   => 'menu_order',
					'order'     => 'ASC',
					'post__in'  => $grandchild_ids
				);
				
				$my_query = null;
				$my_query = new WP_Query($args);

				if( $my_query->have_posts() ) { 
					while ($my_query->have_posts()) : $my_query->the_post(); ?>

					<a class="faculty-photo" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'faculty-list' ); } else { echo '<img src="' . get_stylesheet_directory_uri() . '/_/img/generic_headshot.jpg">'; } ?></a>
				<?php endwhile;
				} ?>
				
		 			</div>
					<a href="<?php echo $the_link; ?>">
						<div class="spacer-container georgia">
							<div class="spacer gradient"><span>Recent</span> Recipients</div>
							<div class="view-all-hover">See more</div>
							<div class="view-all" style="display: block;">»</div>
						</div>
					</a>
		 			<div class="left-arrow">«</div>
					<div class="right-arrow">»</div>
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