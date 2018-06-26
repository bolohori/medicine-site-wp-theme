<?php

$card_class = '';
if ( has_term( 'national-leaders', 'news' ) || has_term( 'obituaries', 'news' ) ) {
	$card_class = ' class="headshot"';
}
?><li<?php echo $card_class; ?>>
	<div>
		<?php
		$home_analytics_title = '';
		if ( has_term( 'national-leaders', 'news' ) && is_front_page() ) {
			$home_analytics_title = 'data-category="Front page" data-action="Cards - National Leaders"';
		} elseif ( is_front_page() ) {
			$home_analytics_title = 'data-category="Front page" data-action="Cards - News"';
		}
		?>
		<a <?php echo $home_analytics_title; ?> href="<?php ( get_field( 'url' ) ? the_field( 'url' ) : the_permalink() ); ?>">
			<div class="card">
				<div class="card-text">
				<?php the_title( '<h2 class="article-title">', '</h2>' ); ?>
				</div>
			</div>
		</a>
	</div>
</li>
