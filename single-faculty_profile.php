<?php 
wp_enqueue_script( 'faculty-recognition', get_stylesheet_directory_uri() . '/_/js/faculty-recognition.js', array( 'jquery-effects-bounce' ) );
get_header(); 
?>

<div id="main" class="clearfix non-landing-page">

	<div id="page-background"></div>

	<div class="wrapper clearfix">

		<div id="page-background-inner"></div>

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
				echo "<div class='faculty-profile-byline'><h3>" . get_field('award_name', $post->ID) . "</h3><span class='faculty-profile-award-set'>";
				$parents = get_post_ancestors( $post->ID );
				$id = ( $parents ) ? $parents[ count( $parents ) - 1 ] : $post->ID;
				echo get_the_title( $id ) . ", " .  get_the_title( $post->post_parent );
				echo "</span></div>";
				the_post_thumbnail( 'full', array('class' => 'faculty-profile-headshot' ) );
				the_content();
				echo "<div class='faculty-profile-date'><strong>Published:</strong> " . get_the_date('m/d/Y') . "</div>";
			?>
			</article>
			<?php
				} else { // This is the "year list" for an award set
			?>

			<article class="faculty-profile-width">

			<?php 
				the_title('<h1>', '</h1>');
				the_content();
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
						<p>Select Year:</p><div class="displayed-year"><p></p>
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
					</div>
					<div id="award-years-right">
						<?php 
						$args = array (
							'post_parent' => $first_year, 
							'post_type'   => 'faculty_profile',
							'orderby'     => 'menu_order',
							'order'       => 'asc',
							'posts_per_page' => -1
						);
						$my_query = new WP_Query( $args );
						if ( $my_query->have_posts() ) { 
							echo "<ul class='award-list'>";
							while ( $my_query->have_posts() ) { 
								$my_query->the_post();
								echo "<li><div class='faculty-individual clearfix'><a href='".get_permalink()."'>";
									the_post_thumbnail();
								echo "</a><div><h2><a href='".get_permalink()."'>".get_the_title()."</a></h2>
										<p class='award-name'>".get_field('award_name')."</p>
										<p>".get_the_excerpt( )."</p></div>
								</div></li>";
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

	</div>

</div>
<script>
jQuery(document).ready(function($) {
    $('.faculty-individual').matchHeight();
});
</script>
<?php get_footer(); ?>