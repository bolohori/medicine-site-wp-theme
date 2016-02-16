<?php
$classyear = get_field( 'class_year_check' );
$args = array(
	'post_type' => 'post',
	'post_status' => 'published',
	'tax_query' => array (
		array (
			'taxonomy' => 'class_year',
			'field' => 'slug',
			'terms' => $classyear->name
		),
	),
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	$i = 1;
?>
<div class="generic-cards">
	<ul class="clearfix">
		<?php while ( $the_query->have_posts() ) {
		$the_query->the_post(); ?>
		<li>
			<div>
				<a href="<?php the_permalink(); ?>">
					<?php if( $i % 2 == 1 ) {
						$cardtype = "odd";
					} else {
						$cardtype = "even";
					}; ?>
					<div class="card <?php echo $cardtype; ?>">
						<?php if( has_post_thumbnail() ) {
							the_post_thumbnail('news');
						} else {
							echo '<img src="'. get_template_directory_uri() . '/_/img/default.jpg">';
						}
						echo '<div class="card-text">';
							echo '<p class="article-date">', the_time('M j, Y'), '</p>';
							the_title('<h2 class="article-title">', '</h2>');
							the_excerpt();
						echo '</div>';
						?>
					</div>
				</a>
			</div>
		</li>
		<?php $i++; } /* end while */ ?>
	</ul>
</div>
<?php } /* end if */ ?>