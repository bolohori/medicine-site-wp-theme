<div class="innovate-magazine-custom-archive-entry custom-archive-entry clearfix">
	<span class="innovate-magazine-custom-archive-date custom-archive-date"><?php the_time( get_option( 'date_format' ) ); ?></span><br>
	<span class="innovate-magazine-custom-archive-link custom-archive-link">
		<a href="<?php ( get_field( 'url' ) ? the_field( 'url' ) : the_permalink() ); ?>"><?php the_title( '<h3>', '</h3>' ); ?></a>
	</span>
	<p class="innovate-magazine-custom-archive-excerpt custom-archive-excerpt">
		<?php the_excerpt(); ?>
	</p>
</div>
