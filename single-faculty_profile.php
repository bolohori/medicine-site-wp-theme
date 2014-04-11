<?php get_header(); ?>

<div id="main" class="clearfix non-landing-page">

	<div id="page-background-r"></div>
	<div id="page-background-l"></div>

	<div class="wrapper">

		<?php get_sidebar(); ?>
		<?php 
		if (have_posts()) :
			while (have_posts()) :
				the_post();
				if( $post->post_parent !== 0 ) { // This is an individual award page
		?>
			<article>
			<?php
				the_title('<h1>', '</h1>');
				echo "<div class='faculty-profile-byline'><h3>" . get_field('award_name') . "</h3><span class='faculty-profile-award-set'>";
				$parents = get_post_ancestors( $post->ID );
				$id = ( $parents ) ? $parents[ count( $parents ) - 1 ] : $post->ID;
				echo get_the_title( $id ) . ", " .  get_the_title( $post->post_parent );
				echo "</span></div>";
				the_post_thumbnail( 'full', array('class' => 'faculty-profile-headshot' ) );
				the_content();
				echo "<div class='faculty-profile-date'><strong>Published:</strong>" . get_the_date('m/d/Y') . "</div>";
			?>
			</article>
			<?php
				} else { // This is the "year list" for an award set
			?>

			<article class="faculty-profile-width">

			<?php 
				the_title('<h1>', '</h1>');
				echo "<p>" . get_the_content() . "</p>";
				$args = array (
					'post_parent' => $post->ID, 
					'post_type'   => 'faculty_profile',
					'orderby'     => 'menu_order',
					'order'       => 'asc' 
				);
				$my_query = new WP_Query( $args );
			?>
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
									echo "<li class='selected-year' data-post_id='" . get_the_ID() . "'>" . get_the_title() . "</li>";
								} else {
									echo "<li data-post_id='" . get_the_ID() . "'>" . get_the_title() . "</li>";
								}
							}
							?>
						</ul>
					</div>
					<div id="award-years-right">
						<?php 
						$args = array (
							'post_parent' => $first_year, 
							'post_type'   => 'faculty_profile',
							'orderby'     => 'menu_order',
							'order'       => 'asc',
						);
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
		</article>

			<?php			
				}
			endwhile;
		endif; ?>

		<?php get_sidebar( 'right' ); ?>

	</div>

</div>
<script>
jQuery(document).ready(function($) {
	$("#year-list li").on("click", function(e) {
		// We'll pass this variable to the PHP function example_ajax_request
		$(".selected-year").removeClass("selected-year");
		$(this).addClass("selected-year");
		var y = $(this).attr("data-post_id"),
			data = {
				'action':'get_awards',
				'year'  : y,
				'_ajax_nonce' : '<?php echo wp_create_nonce("wusm-faculty-profiles"); ?>'
			};

		console.log(data);

		$.post(ajax_object.ajax_url, data, function(data) {
			console.log(data);
			$('#award-years-right').html(data);
		});
	});
});
</script>
<?php get_footer(); ?>