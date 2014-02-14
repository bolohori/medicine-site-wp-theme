<?php
	get_header();
	$class = '';
	$margin = ' non-landing-page';
	$nonce = wp_create_nonce("wusm_nonce");
	echo $post->post_parent;
	if(have_posts()): while(have_posts()): the_post();
		$opener = "<h1>" . get_the_title() . "</h1><p>" . get_the_content() . "</p>";

		$args = array (
			'post_parent' => $post->ID, 
			'post_type'   => 'faculty_profile',
			'orderby'     => 'menu_order',
			'order'       => 'asc' 
		);
		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() ) { 
	?>
			
<div id="main" class="clearfix<?php echo $margin; ?>">
	<div id="hover"></div>
	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper">

		<?php get_sidebar(); ?>

		<article<?php echo $class; ?>>

			<?php echo $opener; ?>
				<div id="all_award-years">
					<div id="award-years-left">
						<p class="georgia">Select Year</p>
						<ul id="year-list">
							<?php 
							$first_year = -1;
							while ( $my_query->have_posts() ) { 
								$my_query->the_post();
								if( $first_year == -1 ) {
									$first_year = get_the_ID();
									echo "<li class='selected-year' data-post_id='" . get_the_ID() . "' data-nonce='" . $nonce . "'>" . get_the_title() . "</li>";
								} else {
									echo "<li data-post_id='" . get_the_ID() . "' data-nonce='" . $nonce . "'>" . get_the_title() . "</li>";
								}
							}
							?>
						</ul>
					</div>
					<div id="award-years-right">
						<?php 
						$args = array ('post_parent' => $first_year, 'post_type' => 'faculty_profile');
						$my_query = new WP_Query( $args );
						if ( $my_query->have_posts() ) { 
							echo "<ul class='award-list'>";
							while ( $my_query->have_posts() ) { 
								$my_query->the_post();
								echo "<li>";
									the_post_thumbnail( 'faculty-list', array( 'class' => 'faculty-photo-med' ) );
								echo "<div class='faculty-descrip'>
										<h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>
										<div>".get_field('award_name')."</div>
										<p>".get_the_excerpt( )."</p>
									</div>
								</li>";
							}
							echo "</ul>";
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		<?php
			}
			wp_reset_postdata();
		endwhile;
		endif;
		?>
		</article>

	</div>

</div>

<?php get_footer(); ?>