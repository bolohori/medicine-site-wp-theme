
<?php
	get_header();
	$class = '';
	$margin = ' non-landing-page';
?>

<div id="main" class="clearfix<?php echo $margin; ?>">
	<div id="hover"></div>
	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper">

		<?php get_sidebar(); ?>

		<article<?php echo $class; ?>>
			<h1>Faculty Recognition</h1>
			<?php
			$args = array( 
				'post_type' => 'faculty_profile',
				'posts_per_page' => -1,
				'post_parent' => 0,
				'orderby' => 'menu_order',
				'order' => 'asc' 
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
					<?php the_content(); ?>
				<div class="photo-container">
				<?php
				$grandchild_ids = array();
				$all = get_pages( array('sort_order' => 'asc', 'sort_column' => 'menu_order', 'post_type' => 'faculty_profile', 'child_of' => $post->ID));
				foreach($all as $all) { 
					if($all->post_parent) { 
						if( get_page($all->post_parent)->post_parent ) { 
							$tp = get_page($all->post_parent);
							if( !get_page( $tp->post_parent )->post_parent) { $grandchild_ids[] = $all->ID; }
						}
					}
				}
				$args = array(
					'post_type' => 'faculty_profile',
					'orderby' => 'date',
					'order' => 'desc',
					'post__in' => $grandchild_ids
				);
				$my_query = null;
				$my_query = new WP_Query($args);
				if( $my_query->have_posts() ) { 
					while ($my_query->have_posts()) : $my_query->the_post(); ?>

					<a class="faculty-photo" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'faculty-list' ) ?></a>
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
		?>
		</article>

		<?php get_sidebar( 'right' ); ?>

	</div>

</div>

<?php get_footer(); ?>